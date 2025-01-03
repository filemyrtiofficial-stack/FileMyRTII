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
                        <h5>Service</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Class Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="class_name" id="class_name" value="{{$data['class_name'] ?? ''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Title</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="title" id="title" value="{{$data['title'] ?? ''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Description Enable in Design</label>
                                    <div class="input-group">
                                        <select type="text" class="form-control" name="description_enable">
                                            @foreach(yesNoOption() as $value)
                                                <option value="{{$value['id'] ?? ''}}" @if(isset($data) && isset($data['description_enable']) && $data['description_enable'] == $value['id']) selected  @endif>{{$value['name'] ?? ''}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                                <div class="form-group">
                                    <label class="form-label"><strong>Services</strong></label>
                                    <div class="service_tabs_service_list" id="sortable_product">
                                        @if(isset($data['service_tabs_service_count']))
                                            @for($index = 0; $index < $data['service_tabs_service_count']; $index++)
                                                <div class="d-flex draggable"  id="row{{$index}}"  draggable="true" productID="{{$index}}">
                                                    <div class="col-lg-9 mt-lg-0">
                                                        <div class="card-body d-flex">
                                                        <input type="radio" name="service_tab" class="service_tab" value="{{$index}}" @if(isset($data['service_tab']) && $data['service_tab'] == $index) checked @endif>
                                                            <select name="service_tabs_service_{{$index}}" id="service_tabs_service_{{$index}}" class="form-control service_tabs_service" data-index="{{$index}}">
                                                                <option value="">Select Service</option>    
                                                            {!! serviceCategoryOptions($data['service_tabs_service_'.$index]) !!}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div><button class="btn btn-sm btn-danger mt-4 service_tabs_remove"><i class="fa fa-trash"></i></button></div>
                                                </div>
                                            @endfor
                                        @else

                                            <div class="d-flex draggable"  id="row0"  draggable="true" productID="0">
                                                <div class="col-lg-9 mt-lg-0">
                                                    <div class="card-body d-flex">
                                                    <input type="radio" name="service_tab" class="service_tab" value="0">
                                                        <select name="service_tabs_service_0" id="service_tabs_service_0" class="form-control service_tabs_service" data-index="0">
                                                            <option value="">Select Service</option>    
                                                        {!! serviceCategoryOptions() !!}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div><button class="btn btn-sm btn-danger mt-4 service_tabs_remove"><i class="fa fa-trash"></i></button></div>
                                            </div>
                                        @endif
                                    </div>
                                    <button class="btn btn-sm btn-secondary service_tabs_add_more" data-tag="service_tabs_service" type="button">Add More</button>
                                    <input type="hidden" id="service_tabs_service_count" name="service_tabs_service_count" value="{{$data['service_tabs_service_count'] ?? '1'}}">
                                    <input type="hidden" id="service_tabs_service_list" name="service_tabs_service_list"  value="{{$data['service_tabs_service_list'] ?? ''}}">

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
        if($('.draggable').length < 4) {

            $('.service_tabs_service_list').append(`<div class="d-flex draggable" >
                                                        <div class="col-lg-9 mt-lg-0 ">
                                                            <div class="card-body d-flex ">
                                                              <input type="radio" name="service_tab" class="service_tab">
                                                                <select name="service_tabs_service_0" id="service_tabs_service_0" class="form-control service_tabs_service">
                                                                    <option value="">Select Service</option> 
                                                                    <?php echo serviceCategoryOptions();?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                       

                                                        <div><button class="btn btn-sm btn-danger mt-4 service_tabs_remove"><i class="fa fa-trash"></i></button></div>
                                                    </div>`);
        }
      
                                            updateServiceSequance();
    });
    function updateServiceSequance(){
        let tag = 'service_tabs_service';
      
        $('.draggable').each(function(index, value){
            $(this).attr('id', 'row'+index).attr('productID', index);
            $(this).find('.'+tag).attr('name', tag+"_"+index).attr('id', tag+"_"+index).attr('data-index', index);
            $(this).find('.service_tab').val(index)
            
        });
        $('#service_tabs_service_count').val($('.'+tag).length);
        var values = [];
        $('.service_tabs_service').each(function(index, value){
            values.push($(this).val());
        }) 
        $('#service_tabs_service_list').val(JSON.stringify(values));
    }
    $(document).on('click', '.service_tabs_remove', function(e){
        $(this).parents().eq(1).remove();
        updateServiceSequance();
    });
    $(document).on('change', '.service_tabs_service', function(e){
       
        var services = $('#service_tabs_service_list').val();
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
       

    });
   
    </script>
@endpush