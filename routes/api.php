<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('create-permission', function(){
    // echo bcrypt("rti@2025");
    // die();
    $permissions = [
            'Customer' => [
                'Manage Customer',
            ],
            'User' => [
                'Manage User',
                'Create User',
                'Edit User',
                'Delete User'

            ],
            'Role' => [
                'Manage Role',
                'Create Role',
                'Edit Role',
                'Delete Role'

            ],
           
            'Team Members' => [
                'Manage Team Member',
                'Create Team Member',
                'Edit Team Member',
                'Delete Team Member'
            ],
            'Lawyer' => [
                'Manage Lawyer',
                'Create Lawyer',
                'Edit Lawyer',
                'Delete Lawyer'
            ],
            'PIO Management' => [
                'Manage PIO',
                'Create PIO',
                'Edit PIO',
                'Delete PIO'
            ],
            'Blog Category' => [
                'Manage Blog Category',
                'Create Blog Category',
                'Edit Blog Category',
                'Delete Blog Category'
            ],
            'Blog' => [
                'Manage Blog',
                'Create Blog',
                'Edit Blog',
                'Delete Blog'
            ],

            'Service category' => [
                'Manage Service category',
                'Create Service category',
                'Edit Service category',
                'Delete Service category'
            ],
            'Service' => [
                'Manage Service',
                'Create Service',
                'Edit Service',
                'Delete Service'
            ],
            'Testimonial' => [
                'Manage Testimonial',
                'Create Testimonial',
                'Edit Testimonial',
                'Delete Testimonial'
            ],

            'Service Template' => [
                'Manage Service Template',
                'Create Service Template',
                'Edit Service Template',
                'Delete Service Template'
            ],
           
           
           
            'Menu' => [
                'Manage Menu'
            ],
            'Pages' => [
                'Manage Pages',
                'Create Pages',
                'Edit Pages',
                'Delete Pages'
            ],
            'Section Data' => [
                'Manage Section Data',
                'Create Section Data',
                'Edit Section Data',
                'Delete Section Data'
            ],
            'Setting' => [
                'Header Footer',
                'Payment'

            ],
            'Newsletter' => [
                'Manage Newsletter Data',

            ],
            'Enquiry' => [
                'Manage Enquiry',
            ],
            'RTI Application' => [
                'Manage RTI Application',
                'Assign Lawyer',

            ],
            'Close Request' => [
                'Manage Request',
                'Approve Request',

            ],
        ];
        print_r($permissions);

        foreach($permissions as $key => $items) {
            $parent_permission = Permission::where(['name' => $key])->first();
            // print_r(json_encode($parent_permission));die;
            if(!$parent_permission) {
                $parent_permission = new Permission;
                $parent_permission->name = $key;
                $parent_permission->guard_name = 'web';
                $parent_permission->parent_id = 0;
                $parent_permission->save();
            }
            foreach($items as $item) {
                
                $permission = Permission::where(['name' => $item])->first();
                if($permission) {
                    $permission->update(['parent_id' => $parent_permission->id]);
                }
                else {
                    $permission = Permission::create(['name' => $item, 'guard_name' => 'web', 'parent_id' => $parent_permission->id]);

                }

            }
        }
});