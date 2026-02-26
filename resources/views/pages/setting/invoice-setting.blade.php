@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page">Invoice Setting</li>

@endsection
@section('content')
<form action="{{route('settings.store')}}" method="post" class="form-submit">
@csrf

<input type="hidden" name="type" value="invoice-setting">

    <div class="d-flex justify-content-center mb-5">
        <div class="col-lg-9 mt-lg-0 mt-4">
    
            <div class="col-lg-12 mt-lg-0 mt-4">
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Invoice</h5>
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
                                                <label class="form-label">Logo</label>
                                                <div class="input-group">
                                                    <input type="file" class=" upload-image dropify" id="invoice_logo_image" @if(isset($data['invoice_logo'])) data-default-file="{{ asset($data['invoice_logo']) }}" @endif>
                                                    <div class="image-collection mt-3" >
                                                        <input hidden type="text" value="{{$data['invoice_logo'] ?? ''}}"  class="form-control image-input" name="invoice_logo" data-lable="invoice_logo" id="invoice_logo">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Company Name</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['company_name'] ?? ''}}" name="company_name" data-lable="company_name" id="company_name">
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
                                     
                                      <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">Invoice Footer</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['invoice_footer'] ?? ''}}" name="invoice_footer" data-lable="invoice_footer" id="invoice_footer">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label class="form-label">GST</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['gst'] ?? ''}}" name="gst" data-lable="gst" id="gst">
                                                </div>
                                            </div>
                                        </div>
                                     
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
