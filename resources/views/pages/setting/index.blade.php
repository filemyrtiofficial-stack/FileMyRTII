@extends('layouts.app')

@section('content')
<form action="{{route('settings.store')}}" method="post" class="form-submit">
@csrf

<input type="hidden" name="type" value="header-footer-setting">

    <div class="d-flex justify-content-center mb-5">
        <div class="col-lg-9 mt-lg-0 mt-4">
    
            <div class="col-lg-12 mt-lg-0 mt-4">
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Settings</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mt-5">
                        <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Images </label>
                                    <div >
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Primary Logo</label>
                                                <div class="input-group">
                                                    <input type="file" class=" upload-image dropify" id="primary_logo_image" @if(isset($data['primary_logo'])) data-default-file="{{ asset($data['primary_logo']) }}" @endif>
                                                    <div class="image-collection mt-3" >
                                                        <input hidden type="text" value="{{$data['primary_logo'] ?? ''}}"  class="form-control image-input" name="primary_logo" data-lable="primary_logo" id="primary_logo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Secondary Logo</label>
                                                <div class="input-group">
                                                    <input type="file" class=" upload-image dropify" id="secondary_logo_image" @if(isset($data['secondary_logo'])) data-default-file="{{ asset($data['secondary_logo']) }}" @endif>
                                                    <div class="image-collection mt-3" >
                                                        <input hidden type="text" value="{{$data['secondary_logo'] ?? ''}}"  class="form-control image-input" name="secondary_logo" data-lable="secondary_logo" id="secondary_logo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">header Timing</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['timing'] ?? ''}}" name="timing" data-lable="timing" id="timing">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Footer Logo Tagline</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['footer_logo_tagline'] ?? ''}}" name="footer_logo_tagline" data-lable="footer_logo_tagline" id="footer_logo_tagline">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Address</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['address'] ?? ''}}" name="address" data-lable="address" id="address">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Email Id</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['email'] ?? ''}}" name="email" data-lable="email" id="email">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Contact No.</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['contact_no'] ?? ''}}" name="contact_no" data-lable="contact_no" id="contact_no">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5><strong>Social Media Links</strong></h5>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>Linkedin</th>
                                                <th><input type="text" name="linkedin" id="linkedin" class="form-control"></th>
                                            </tr>
                                            <tr>
                                                <th>Facebook</th>
                                                <th><input type="text" name="facebook" id="facebook" class="form-control"></th>
                                            </tr>
                                            <tr>
                                                <th>Twitter</th>
                                                <th><input type="text" name="twitter" id="twitter" class="form-control"></th>
                                            </tr>
                                            <tr>
                                                <th>Youtube</th>
                                                <th><input type="text" name="youtube" id="youtube" class="form-control"></th>
                                            </tr>
                                            <tr>
                                                <th>Instagram</th>
                                                <th><input type="text" name="instagram" id="instagram" class="form-control"></th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                           


                            </div>
                        </div>
    
                    </div>
                </div>
            </div>
            <div class="mt-5 float-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
        </div>
    </div>
</form>
@endsection
