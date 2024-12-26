<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EnquiryForm;
use App\Repositories\EnquiryRepository;
use App\Interfaces\EnquiryInterface;
class EnquiryController extends Controller
{

    private EnquiryRepository $enquiryRepository;

    public function __construct(EnquiryInterface $enquiryRepository)
    {
        $this->enquiryRepository = $enquiryRepository;
    }


    public function index(Request $request) {
        $list = EnquiryForm::list(true, $request->all());
        return view('pages.enquiry.index', compact('list'));
        
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $data = $this->enquiryRepository->delete($id);
            return response(['message' => 'Data is successfully deleted']);
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()], 500);
        }
    }
}
