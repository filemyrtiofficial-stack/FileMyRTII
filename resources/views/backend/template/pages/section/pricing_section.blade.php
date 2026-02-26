@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page"><a href="{{route('pages.index')}}">Page Management</a></li>
@if($page_type == 'page')
     @if(isset($page) && isset($page->id))
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('pages.edit', $page->id)}}">{{$page->title}}</a></li>
    @endif
@elseif($page_type == 'service')

     @if(isset($page) && isset($page->id))
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('services.edit', $page->id)}}">{{$page->name}}</a></li>
    @endif
@elseif($page_type == 'service-category')
     @if(isset($page) && isset($page->id))
    <li class="breadcrumb-item" aria-current="page"><a href="{{route('service-category.edit', $page->id)}}">{{$page->name}}</a></li>
    @endif

@endif

<li class="breadcrumb-item active" aria-current="page">{{$template['section_name'] ?? ''}}</li>

@endsection
@section('content')
<form action="{{route('update-page-section', $page_id)}}" method="post" class="form-submit">
@csrf
<input type="hidden" name="section_key" value="{{$section_key}}">
<input type="hidden" name="key" value="{{$id}}">
<input type="hidden" name="page_type" value="{{$page_type}}">

    <div class="d-flex justify-content-center mb-5">
        <div class="col-lg-9 mt-lg-0 mt-4">
    
            <div class="col-lg-12 mt-lg-0 mt-4">
                <div class="card mt-4">
                    <div class="card-header">
                        <h5>Pricing Section</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Title</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" value="{{$data['title'] ?? ''}}" name="title" data-lable="title" id="title">
                                    </div>
                                </div>
                            </div>
                           
                           
                            <div class="col-12">
                                <hr>
                                <div class="form-group">
                                    <label class="form-label"><strong>List</strong></label>
                                    <div class="what_we_dolist" id="sortable_product">
                                       
                                        @if(isset($data['what_we_docount']))
                                            @for($index = 0; $index < $data['what_we_docount']; $index++)
                                                @if(isset($data['what_we_do_'.$index]))
                                                    <div class="d-flex draggable"  id="row{{$index}}"  draggable="true" productID="{{$index}}">
                                                        <div class="col-lg-9 mt-lg-0">
                                                            <div class="card-body">
                                                                <select name="what_we_do_{{$index}}" id="what_we_do_{{$index}}" class="form-control what_we_do data-index="{{$index}}">
                                                                    <option value="">Select </option>    
                                                                {!! sectionTemplateOptions('what_we_do',$data['what_we_do_'.$index]) !!}
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div><button class="btn btn-sm btn-danger mt-4 service_tabs_remove"><i class="fa fa-trash"></i></button></div>
                                                    </div>
                                                @endif
                                            @endfor
                                        @else

                                            <div class="d-flex draggable"  id="row0"  draggable="true" productID="0">
                                                <div class="col-lg-9 mt-lg-0">
                                                    <div class="card-body">
                                                        <select name="what_we_do_0" id="what_we_do_0" class="form-control what_we_do data-index="0">
                                                            <option value="">Select</option>    
                                                        {!! sectionTemplateOptions('what_we_do') !!}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div><button class="btn btn-sm btn-danger mt-4 service_tabs_remove"><i class="fa fa-trash"></i></button></div>
                                            </div>
                                        @endif
                                    </div>
                                    <button class="btn btn-sm btn-secondary service_tabs_add_more" data-tag="what_we_do" type="button">Add More</button>
                                    <input type="hidden" id="what_we_docount" name="what_we_docount" value="{{$data['what_we_docount'] ?? '1'}}">
                                    <input type="hidden" id="what_we_dolist" name="what_we_dolist"  value="{{$data['what_we_dolist'] ?? ''}}">

                                    <hr>
                                    <h4>Section 2</h4>
                                    <hr>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Title</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="{{$data['section_title'] ?? ''}}" name="section_title" data-lable="section_title" id="section_title">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" value="{{$data['section_description'] ?? ''}}" name="section_description" data-lable="section_description" id="section_description">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Image 1 @if(isset($data) && isset($data['image'])) <a href="{{ asset($data['image']) }}" target="blank"><img src="{{ asset($data['image']) }}" alt="" width="50"></a>@endif</label>
                                            <div class="input-group">
                                                <input type="file" class=" upload-image dropify" id="image1" @if(isset($data) && isset($data['image'])) data-default-file="{{ asset($data['image']) }}" @endif>
                                                <div class="image-collection mt-3" >
                                                    <input hidden type="text" value="{{$data['image'] ?? ''}}"  class="form-control image-input" name="image" data-lable="image" id="image">
                                                    <input placeholder="Alternative text" type="text" value="{{$data['image_alt'] ?? ''}}" id="image_alt" name="image_alt" class="form-control w-100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">CTA Button</label>
                                    <div class="input-group">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Title</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['link_title'] ?? ''}}" name="link_title" data-lable="link_title" id="link_title">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-label">Url</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['link_url'] ?? ''}}" name="link_url" data-lable="link_url" id="link_url">
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
@push('js')
<script>
    $(document).on('click', '.service_tabs_add_more', function(e){
        e.preventDefault();

            $('.what_we_dolist').append(`<div class="d-flex draggable" >
                                                        <div class="col-lg-9 mt-lg-0 ">
                                                            <div class="card-body">
                                                                <select name="what_we_do_0" id="what_we_do_0" class="form-control what_we_do">
                                                                    <option value="">Select </option> 
                                                                    <?php echo sectionTemplateOptions('what_we_do');?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div><button class="btn btn-sm btn-danger mt-4 service_tabs_remove"><i class="fa fa-trash"></i></button></div>
                                                    </div>`);
      
                                            updateServiceSequance();
    });
    function updateServiceSequance(){
        let tag = 'what_we_do';
      
        $('.draggable').each(function(index, value){
            $(this).attr('id', 'row'+index).attr('productID', index);
            $(this).find('.'+tag).attr('name', tag+"_"+index).attr('id', tag+"_"+index).attr('data-index', index);
            
        });
        $('#what_we_docount').val($('.'+tag).length);
        var values = [];
        $('.what_we_do').each(function(index, value){
            values.push($(this).val());
        }) 
        $('#what_we_dolist').val(JSON.stringify(values));
    }
    $(document).on('click', '.service_tabs_remove', function(e){
        $(this).parents().eq(1).remove();
        updateServiceSequance();
    });
    $(document).on('change', '.what_we_do', function(e){
       
        var services = $('#what_we_dolist').val();
        if(services != '') {
            services = JSON.parse(services);
        }
        else {
            services = [];
        }

        if($(this).val() != '') {
            
            if(services.indexOf($(this).val()) != -1) {
                $(this).val('').change();
                return false;
            }
           
        }
        updateServiceSequance();
       

    })
    </script>
@endpush