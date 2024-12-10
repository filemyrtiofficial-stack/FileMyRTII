@extends('layouts.app')

@section('content')
<form action="{{route('update-page-section', $page_id)}}" method="post" class="form-submit">
@csrf
<input type="hidden" name="section_key" value="{{$section_key}}">
<input type="hidden" name="key" value="{{$id}}">

    <div class="d-flex justify-content-center mb-5">
        <div class="col-lg-9 mt-lg-0 mt-4">
    
            <div class="col-lg-12 mt-lg-0 mt-4">
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Footer Banner</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                        <label class="form-label">Title</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$data['title'] ?? ''}}" name="title" id="title">
                                    </div>
                                </div>
                            </div>
                            
                          
                            <div class="col-12">
                                    <hr>
                                    <div class="form-group">
                                        <label class="form-label"><strong>Banner</strong></label>
                                            

                                            <div class="d-flex "  id="row0"  draggable="true" productID="0">
                                                <div class="col-lg-9 mt-lg-0">
                                                    <div class="card-body">
                                                        <select name="banner" id="banner" class="form-control " >
                                                            <option value="">Select</option>    
                                                        {!!  sectionTemplateOptions('footer_banner')!!}
                                                        </select>
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
    </div>
</form>
@endsection
@push('js')

@endpush