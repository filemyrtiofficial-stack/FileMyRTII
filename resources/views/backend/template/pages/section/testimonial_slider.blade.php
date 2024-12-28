@extends('layouts.app')

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
                        <h5>Testimonial Slider</h5>
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
                                    <label class="form-label"><strong>Testimonial</strong></label>
                                    <div class="testimonial_list" id="sortable_product">
                                        @if(isset($data['testimonial_count']))
                                            @for($index = 0; $index < $data['testimonial_count']; $index++)
                                                <div class="d-flex draggable"  id="row{{$index}}"  draggable="true" productID="{{$index}}">
                                                    <div class="col-lg-9 mt-lg-0">
                                                        <div class="card-body">
                                                            <select name="testimonial_{{$index}}" id="testimonial_{{$index}}" class="form-control testimonial" data-index="{{$index}}">
                                                                <option value="">Select testimonial</option>    
                                                            {!! TestimonialOptions($data['testimonial_'.$index]) !!}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div><button class="btn btn-sm btn-danger mt-4 service_tabs_remove"><i class="fa fa-trash"></i></button></div>
                                                </div>
                                            @endfor
                                        @else

                                            <div class="d-flex draggable"  id="row0"  draggable="true" productID="0">
                                                <div class="col-lg-9 mt-lg-0">
                                                    <div class="card-body">
                                                        <select name="testimonial_0" id="testimonial_0" class="form-control testimonial" data-index="0">
                                                            <option value="">Select Testimonial</option>    
                                                        {!! TestimonialOptions() !!}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div><button class="btn btn-sm btn-danger mt-4 service_tabs_remove"><i class="fa fa-trash"></i></button></div>
                                            </div>
                                        @endif
                                    </div>
                                    <button class="btn btn-sm btn-secondary service_tabs_add_more" data-tag="testimonial" type="button">Add More</button>
                                    <input type="hidden" id="testimonial_count" name="testimonial_count" value="{{$data['testimonial_count'] ?? '1'}}">
                                    <input type="hidden" id="testimonial_list" name="testimonial_list"  value="{{$data['testimonial_list'] ?? ''}}">

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
        if($('.draggable').length < 3) {

            $('.testimonial_list').append(`<div class="d-flex draggable" >
                                                        <div class="col-lg-9 mt-lg-0 ">
                                                            <div class="card-body">
                                                                <select name="testimonial_0" id="testimonial_0" class="form-control testimonial">
                                                                    <option value="">Select testimonial</option> 
                                                                    <?php echo TestimonialOptions();?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div><button class="btn btn-sm btn-danger mt-4 service_tabs_remove"><i class="fa fa-trash"></i></button></div>
                                                    </div>`);
        }
      
                                            updateServiceSequance();
    });
    function updateServiceSequance(){
        let tag = 'testimonial';
      
        $('.draggable').each(function(index, value){
            $(this).attr('id', 'row'+index).attr('productID', index);
            $(this).find('.'+tag).attr('name', tag+"_"+index).attr('id', tag+"_"+index).attr('data-index', index);
            
        });
        $('#testimonial_count').val($('.'+tag).length);
        var values = [];
        $('.testimonial').each(function(index, value){
            values.push($(this).val());
        }) 
        $('#testimonial_list').val(JSON.stringify(values));
    }
    $(document).on('click', '.service_tabs_remove', function(e){
        $(this).parents().eq(1).remove();
        updateServiceSequance();
    });
    $(document).on('change', '.testimonial', function(e){
       
        var services = $('#testimonial_list').val();
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