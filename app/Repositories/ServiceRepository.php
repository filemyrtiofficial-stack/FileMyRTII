<?php
namespace App\Repositories;
use App\Interfaces\ServiceInterface;
use Carbon\Carbon;
use App\Models\Service;
use App\Models\SlugMaster;
use App\Models\ServiceData;
use App\Models\SeoMaster;

use Session;
use Exception;
use App\Models\RtiApplicationLawyer;
use App\Models\RtiApplication;
use App\Models\ServiceTemplate;

use App\Jobs\SendEmail;
use App\Models\Notification;
class ServiceRepository implements ServiceInterface {

    public function store($request) {
        $faq = $request->only(['question', 'answer']);
        $service = Service::create([
            'name' => $request['name'],
            'icon' => uploadFile($request, 'icon', 'icon'),
            'mobile_banner' => uploadFile($request, 'mobile_banner', 'service'),
            'desktop_banner' => uploadFile($request, 'desktop_banner', 'service'),
            'image_1' => uploadFile($request, 'image_1', 'service'),
            'image_2' => uploadFile($request, 'image_2', 'service'),
            'status' => $request->status,
            'description' => $request->description,
            'category_id' => $request->category,
            // 'fields' => json_encode($request->all()),
            'faq' => json_encode($faq),
            'create_new_page' => $request['create_new_page']
            ],
        );
        SlugMaster::create(['slug' => $request['slug'], 'linkable_id' => $service->id, 'linkable_type' => "services"]);
        $seo_data = $request->only(['meta_title', 'meta_keywords', 'meta_description']);
        $seo_data['linkable_type'] = 'services';
        $seo_data['linkable_id'] = $service->id;
        SeoMaster::createUpdateSeo( $seo_data);
        Session::flash("success", "Data successfully added");
        return response(['message' => "Data successfully added", 'redirect' => route('services.edit',$service->id)]);
    }

    public function update($request, $id) {
        $faq = $request->only(['question', 'answer']);

        $data = [
            'name' => $request['name'],
            'status' => $request->status,
            'description' =>  $request['description'],
            'category_id' => $request['category'],
            // 'fields' => json_encode($request->all()),
            'faq' => json_encode($faq),
            'create_new_page' => $request['create_new_page']
        ];


        $image = uploadFile($request, 'icon', 'icon');
        if(!empty($image)) {
            $data['icon'] = $image;
        }

        Service::where('id', $id)->update($data);
        if(!empty($request['slug'])) {
            SlugMaster::createUpdateSlug(['slug' => $request['slug'], 'linkable_id' => $id, 'linkable_type' => "services"]);
        }
        $seo_data = $request->only(['meta_title', 'meta_keywords', 'meta_description']);
        $seo_data['linkable_type'] = 'services';
        $seo_data['linkable_id'] = $id;
        SeoMaster::createUpdateSeo( $seo_data);

        if(!empty($request->update_array)) {

            $update_array = json_decode($request->update_array, true);

            $page_data = ServiceData::wherein('id', $update_array)->get();
            foreach($page_data as $item) {
                $item->sequance = array_search($item->id, $update_array);
                $item->save();
            }
        }


        Session::flash("success", "Data successfully updated");
        return response(['message' => "Data successfully updated", 'redirect' => route('services.edit',$id)]);
    }




    public function delete($id) {
        $data = Service::where(['id' => $id])->first();
        if($data) {
            if($data->rtiApplications && empty($data->rtiApplications)) {
            throw new Exception("Your Can't delete this service because of some dependency.");

            }
            if($data->slug) {
                $data->slug()->delete();
            }
            $data->delete();
        }
        else {
            throw new Exception("Invalid Service");

        }
    }



    public function deleteSection($id) {
        $data = ServiceData::where(['id' => $id])->first();
        if($data) {
            $data->delete();
        }
        else {
            throw new Exception("Invalid section");

        }
    }

    public function assignLawyer($id, $request) {

        $rti = RtiApplication::get($id);
        $old_lawyer = $rti->lawyer_id;
        RtiApplicationLawyer::create(['application_id' => $id, 'lawyer_id' => $request['lawyer']]);
        $rti->update(['lawyer_id' => $request['lawyer']]);
        if(count($rti->lawyers) == 1) {

            SendEmail::dispatch('assign-lawyer', $rti);
            $html = view('email.assign_lawyer',['data' => $rti])->render();
            Notification::sendCustomerNotification('assign-lawyer', $rti, ['mail' => $html ]);

        }
        if($old_lawyer != $request['lawyer']) {

            SendEmail::dispatch('assign-new-lawyer', $rti);
        }
        Session::flash("success", "Lawyer is successfully assigned");
        return response(['message' => "Lawyer is successfully assigned"]);
    }

    public function storeTemplate($data, $service_id) {
        $template = ServiceTemplate::create(['template_name' => $data['name'], 'template' => $data['description'], 'service_id' => $service_id, 'title' => $data['title'], 'sub_title' => $data['sub_title'], 'signature' => $data['signature']]);
        Session::flash("success", "Template is successfully created");
        return response(['message' => "Template is successfully created", 'redirect' => route('service-template.edit', [$service_id, $template->id])]);
    }


    public function updateTemplate($data, $id) {
        $template = ServiceTemplate::where('id', $id)->update(['template_name' => $data['name'], 'template' => $data['description'], 'title' => $data['title'], 'sub_title' => $data['sub_title'], 'signature' => $data['signature']]);
        Session::flash("success", "Template is successfully updated");
        return response(['message' => "Template is successfully updated"]);
    }

    public function storeFields($request, $service_id) {
        $service = Service::find($service_id);
        if($service) {
            $service->update(['fields' => $request->all()]);
        }
        Session::flash("success", "Fields is successfully updated");
        return response(['message' => "Fields is successfully updated"]);
    }
    
     public function deleteRTI($id) {
        $rti = RtiApplication::find($id);
        if($rti) {
            if($rti->appeal_no == 1 && $rti->secondAppeal) {
                throw new Exception("You can't delete this rti because this rti have second appeal. If you want to delete this rti you have to delete second appeal.");

            }
            if($rti->appeal_no == 0 && $rti->firstAppeal) {
                throw new Exception("You can't delete this rti because this rti have first appeal. If you want to delete this rti you have to delete first appeal.");

            }
            // if($rti->payment_status == 'paid') {
            //     throw new Exception("RTI payment is done that's why you can't delete this rti.");

            // }

                if($rti->lastLawyerEntries) {
                    $rti->lastLawyerEntries()->delete();
                }
                if($rti->courierTracking) {
                    $rti->courierTracking()->delete();
                }
                if($rti->rtiQueries) {
                    $rti->rtiQueries()->delete();
                }
                 if($rti->allDrafts) {
                    $rti->allDrafts()->delete();
                }
                if($rti->appealDeatils) {
                    $rti->appealDeatils()->delete();
                }
                if($rti->notifications) {
                    $rti->notifications()->delete();
                }
    
                  $rti->forceDelete();


            
        }
       else {
            throw new Exception("Invalid RTI");

        }



    }



}
