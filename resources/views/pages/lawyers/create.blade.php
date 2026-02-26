@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page"><a href="{{route('lawyers.index')}}">Lawyers</a></li>
@if(isset($data['id']) )
<li class="breadcrumb-item active" aria-current="page">Edit</li>
@else
<li class="breadcrumb-item active" aria-current="page">Create</li>
@endif
@endsection
@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Lawyer Management'])
<div class="d-flex justify-content-center mb-5">
    <div class="col-lg-9 mt-lg-0 mt-4">
        <div class="card mt-4">
            <div class="card-header">
                <h5>{{isset($data['id']) ? 'Edit' : 'Add'}} Lawyer</h5>
            </div>
            <div class="card-body pt-0">
                <form method="POST"
                    action="{{isset($data['id']) ? route('lawyers.update', $data['id']) : route('lawyers.store')}}"
                    enctype="multipart/form-data" class="form-submit" method="post">
                    @csrf
                    @if(isset($data['id']))
                    <input type="hidden" name="_method" value="PUT">
                    @endif
                 
                    <div class="row mt-5">
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">First Name</label>
                                <div class="input-group">
                                    <input id="first_name" name="first_name" value="{{$data['first_name'] ?? ''}}" class="form-control"
                                        type="text" placeholder="First Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Last Name</label>
                                <div class="input-group">
                                    <input id="last_name" name="last_name" value="{{$data['last_name'] ?? ''}}" class="form-control"
                                        type="text" placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                        @if($data['employee_id'] ?? '')
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Employee ID</label>
                                <div class="input-group">
                                    <input id="employee_id" name="employee_id" value="{{$data['employee_id'] ?? ''}}" class="form-control"
                                        type="text" placeholder="Employee ID" disabled>
                                </div>
                            </div>
                        </div> 
                        @endif
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">DOB</label>
                                <div class="input-group">
                                    <input id="dob" name="dob" value="{{$data['dob'] ?? ''}}" class="form-control"
                                        type="date" placeholder="DOB">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Phone No.</label>
                                <div class="input-group">
                                    <input id="phone" name="phone" value="{{$data['phone'] ?? ''}}" class="form-control"
                                        type="text" min="6" max="15" placeholder="Phone No.">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Company email ID (@filemyrti.com)</label>
                                <div class="input-group">
                                    <input id="email" name="email" value="{{$data['email'] ?? ''}}" class="form-control"
                                        type="email" placeholder="Company email ID (@filemyrti.com)">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input id="password" name="password" type="password" class="form-control password"
                                        type="text" min="6" max="15" placeholder="Password">
                                </div>
                                 <div class="show-password-section mb-1-2">
                                        <input type="checkbox" class="show-password" id="register-show-password"><label for="register-show-password" class="ml-2">Show Password</label>
                                    </div>
                                
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Educational & Technical Qualification</label>
                                <div class="input-group">
                                    <input id="qualification" name="qualification" value="{{$data['qualification'] ?? ''}}" class="form-control"
                                        type="text" placeholder="Educational & Technical Qualification">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Experience</label>
                                <div class="input-group">
                                    <input id="experience" name="experience" value="{{$data['experience'] ?? ''}}" class="form-control"
                                        type="text" placeholder="Experience">
                                </div>
                            </div>
                        </div> -->
                                
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <div class="input-group">
                                    <select name="status" id="status" class="form-control">
                                        @foreach(commonStatus() as $key => $item)
                                        <option value="{{$key}}" @if(isset($data['status']) && $data['status']==$key)
                                            selected @endif>
                                            {{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Father Name/Spouse Name</label>
                                <div class="input-group">
                                    <input id="father_spouse_name" name="father_spouse_name" value="{{$data->lawyerProfile->father_spouse_name ?? ''}}" class="form-control"
                                        type="text" placeholder="Father Name/Spouse Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Mother Name</label>
                                <div class="input-group">
                                    <input id="mother_name" name="mother_name" value="{{$data->lawyerProfile->mother_name ?? ''}}" class="form-control"
                                        type="text" placeholder="Mother Name">
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Emergency/ Alternative Phone No. </label>
                                <div class="input-group">
                                    <input id="alternative_phone_no" name="alternative_phone_no" value="{{$data->lawyerProfile->alternative_phone_no ?? ''}}" class="form-control"  type="text" min="6" max="15" placeholder="Emergency/ Alternative Phone No.">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Personal Email ID</label>
                                <div class="input-group">
                                    <input id="personal_email_id" name="personal_email_id" value="{{$data->lawyerProfile->personal_email_id ?? ''}}" class="form-control"  type="email" placeholder="Personal Email ID">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Gender</label>
                                <div class="input-group">
                                    <select name="gender" id="gender" class="form-control">
                                        @foreach(commonGenders() as $key => $item)
                                        <option value="{{$key}}" @if(isset($data->lawyerProfile->gender) && $data->lawyerProfile->gender ==$key)
                                            selected @endif>
                                            {{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Marital Status</label>
                                <div class="input-group">
                                    <select name="marital_status" id="marital_status" class="form-control">
                                        @foreach(maritalStatus() as $key => $item)
                                        <option value="{{$key}}" @if(isset($data->lawyerProfile->marital_status) && $data->lawyerProfile->marital_status ==$key)
                                            selected @endif>
                                            {{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Date of Joining </label>
                                <div class="input-group">
                                    <input id="date_of_joining" name="date_of_joining" value="{{$data->lawyerProfile->date_of_joining ?? ''}}" class="form-control" type="date" placeholder="Date of Joining">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Exit Date </label>
                                <div class="input-group">
                                    <input id="exit_date" name="exit_date" value="{{$data->lawyerProfile->exit_date ?? ''}}" class="form-control"  type="date" placeholder="Exit Date">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Account holder</label>
                                <div class="input-group">
                                    <input id="bank_account_holder" name="bank_account_holder" value="{{$data->lawyerProfile->bank_account_holder ?? ''}}" class="form-control" type="text" placeholder="Account holder">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Bank name</label>
                                <div class="input-group">
                                    <input id="bank_name" name="bank_name" value="{{$data->lawyerProfile->bank_name ?? ''}}" class="form-control"
                                        type="text" placeholder="Bank name">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Bank address</label>
                                <div class="input-group">
                                    <input id="bank_address" name="bank_address" value="{{$data->lawyerProfile->bank_address ?? ''}}" class="form-control"
                                        type="text" placeholder="Bank address">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Account number</label>
                                <div class="input-group">
                                    <input id="bank_account_number" name="bank_account_number" value="{{$data->lawyerProfile->bank_account_number ?? ''}}" class="form-control"
                                        type="text" placeholder="Account number">
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">IFSC code</label>
                                <div class="input-group">
                                    <input id="bank_ifsc_code" name="bank_ifsc_code" value="{{$data->lawyerProfile->bank_ifsc_code ?? ''}}" class="form-control"
                                        type="text" placeholder="IFSC code">
                                </div>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="form-group">
                                <label class="form-label">Blood Group</label>
                                <div class="input-group">
                                    <!-- <input id="blood_group" name="blood_group" value="{{$data->lawyerProfile->blood_group ?? ''}}" class="form-control" type="text" placeholder="Blood Group"> -->
                                    <select name="blood_group" id="blood_group" class="form-control">
                                        @foreach(bloodGroup() as $key => $item)
                                        <option value="{{$key}}" @if(isset($data->lawyerProfile->blood_group) && $data->lawyerProfile->blood_group ==$key)
                                            selected @endif>
                                            {{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <!-- <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">About</label>
                                <div class="input-group">
                                    <textarea name="about" class="form-control" id="about" rows="12">{{$data['about'] ?? ''}}</textarea>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Address for correspondence</label>
                                <div class="input-group">
                                    <textarea name="address" class="form-control" id="address" rows="12">{{$data['address'] ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Photograph</label>
                                <div class="input-group">
                                <input type="hidden" name="image_preview" id="image_preview" @if(isset($data)) value="{{$data->image }}" @endif>

                                    <input name="image" type="file" class="form-control dropify" id="image" @if(isset($data)) data-default-file="{{ asset($data->image) }}" @endif>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Package Details</label>
                                <div class="input-group">
                                    <textarea name="package_details" class="form-control" id="package_details" rows="12">{{$data->lawyerProfile->package_details ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label class="form-label">Remarks</label>
                                <div class="input-group">
                                    <textarea name="remarks" class="form-control" id="remarks" rows="12">{{$data->lawyerProfile->remarks ?? ''}}</textarea>
                                </div>
                            </div>
                        </div>

                       
                        <div class="col-12">
                        <hr>
                            <h5>Attachments (Resume / PAN / Aadhar, Certificates, etc.)</h5>
                            <div class="document row mb-3" id="sortable_product">
                            @if(isset($data->lawyerProfile->attachments ))
                                @foreach($data->lawyerProfile->attachments['document_name'] ?? [] as $key => $value)
                                    <div class="col-lg-6 draggable mb-3"  id="row{{$key}}"  draggable="true" productID="{{$key}}">
                                        <div class=" mt-lg-0 card">
                                            <div class="card-body">

                                                <div class="col-12">
                                                    <div class="form-group">
                                                            <label class="form-label">Title</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control document_name" value="{{$value}}" name="document_name[]" id="document_name">
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Image</label>
                                                        <div class="input-group">
                                                            <input type="file" class="upload-image dropify" id="upload-image_{{$key}}" data-default-file="{{asset($data->lawyerProfile->attachments['images'][$key]) ?? ''}}">
                                                                <input hidden type="text"  class="form-control image-input document_name_image image-input" value="{{$data->lawyerProfile->attachments['images'][$key] ?? ''}}" name="document_name_image[]" id="document_name_image_{{$key}}">
                                                            
                                                        </div>
                                                       
                                                        <a href="{{filePreview($data->lawyerProfile->attachments['images'][$key])}}"  target="blank" class="preview ">Preview</a>
                                                     
                                                    </div>
                                                </div>
                                                <button class="btn btn-sm btn-danger mt-4 document_remove" type="button">Remove</button>

                                            </div>
                                        </div>
                                    
                                    </div>
                                @endforeach
                            @endif
                               
                            </div>
                            <input type="hidden" name="document_row_count" id="document_row_count" value="{{$data['document_row_count'] ?? 1}}">

                            <button type="button" class="btn btn-primary btn-sm add-module-section"  data-key="0">Add More</button>
                    </div>


                    </div>
                    <div class="mt-5 text-right">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
<script>
  
    $(document).on('click', '.document_remove', function(e){
        $(this).parents().eq(2).remove();
        restructureList();
    })
    $(document).on('click', '.add-module-section', function(e){
        e.preventDefault();
    
     renderHtml();

    });
   
    
    function renderHtml(){
        $('.document').append(`<div class="col-lg-6 draggable mb-3"  id="row0"  draggable="true" productID="0">
                                    <div class=" mt-lg-0 card">
                                        <div class="card-body">

                                            <div class="col-12">
                                                <div class="form-group">
                                                        <label class="form-label">Title</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control document_name" name="document_name[]" id="document_name">
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label">Image</label>
                                                    <div class="input-group">
                                                        <input type="file" class=" upload-image dropify upload-final-pdf" >
                                                            <input hidden type="text"  class="form-control image-input document_name_image" name="document_name_image[]" id="document_name_image_0">
                                                    </div>
                                                        <a href="" class="preview   hide " target="blank">Preview</a>

                                                </div>

                                            </div>
                                            <button class="btn btn-sm btn-danger mt-4 document_remove" type="button">Remove</button>

                                        </div>
                                    </div>
                                 
                                </div>`);
     $('.dropify').dropify();
     restructureList();

    }
    function restructureList() {
        $('.draggable').each(function(index, value){
            $(this).attr('id', 'row'+index).attr('productID', index);
            $(this).find('.upload-image').attr('id', 'upload-image'+index);
            $(this).find('.document_name').attr('id', 'document_name_'+index);
            $(this).find('.document_name_image').attr('id', 'document_name_image_'+index);



        });
        $('#document_row_count').val($('.document_name').length);
    }
    </script>
@endpush