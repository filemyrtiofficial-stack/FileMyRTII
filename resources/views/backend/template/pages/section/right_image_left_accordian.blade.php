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
                        <h5>Right Image Left Text</h5>
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


                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">Image 1</label>
                                        <div class="input-group">
                                            <input type="file" class=" upload-image dropify" id="image1">
                                            <div class="image-collection mt-3" >
                                                <input hidden type="text" value="{{$data['image_1'] ?? ''}}"  class="form-control image-input" name="image_1" data-lable="image_1" id="image_1">
                                                <input placeholder="Alternative text" type="text" value="{{$data['image_1_alt'] ?? ''}}" id="image_1_alt" name="image_1_alt" class="form-control w-100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                                <h5>Accordian List</h5>
                                <div class="accordian-list">
                                    @if(isset($data))
                                        @foreach($data['accordian_title'] as $key => $value)
                                            <div class="card mb-3">
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label class="form-label">Title</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="accordian_title[]" value="{{$value}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="form-label">Description</label>
                                                        <div class="input-group">
                                                            <textarea type="text" class="form-control editor1" name="accordian_description[]">{{$data['accordian_description'][$key]}}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label class="form-label">Title</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="accordian_title[]">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Description</label>
                                                    <div class="input-group">
                                                        <textarea type="text" class="form-control editor1" name="accordian_description[]"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="text-right mt-2">
                                    <button type="button" class="btn btn-sm btn-secondary add-more-accordian">Add More</button>
                                </div>
                            </div>

                        </div>
    
                    </div>
                    <div class="mt-3 float-right">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@push('js')
<script>
    $(document).on('click', '.add-more-accordian', function(e) {
        addAccordian()
    });
    function addAccordian() {
        $('.accordian-list').append(`<div class="card mb-3">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label class="form-label">Title</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="accordian_title[]">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Description</label>
                                                <div class="input-group">
                                                    <textarea type="text" class="form-control editor1" name="accordian_description[]"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>`);

    }
</script>
@endpush
