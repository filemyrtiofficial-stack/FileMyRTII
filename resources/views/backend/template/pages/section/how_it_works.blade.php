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
                        <h5>How it works</h5>
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
                                <div class="form-group">
                                    <label class="form-label">CTA Button</label>
                                    <div class="input-group">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Title</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['how_it_work_link_title'] ?? ''}}" name="how_it_work_link_title" data-lable="how_it_work_link_title" id="how_it_work_link_title">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="form-label">Url</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$data['how_it_work_link_url'] ?? ''}}" name="how_it_work_link_url" data-lable="how_it_work_link_url" id="how_it_work_link_url">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                          
                            <div class="col-12">
                                    <hr>
                                    <div class="form-group">
                                        <label class="form-label"><strong>Services</strong></label> (<span class="text-danger">Note : You can add only 3 list</span>)
                                        <div class="how_it_work_list" id="sortable_product">
                                            @if(isset($data['how_it_work_count']))
                                                @for($index = 0; $index < $data['how_it_work_count']; $index++)
                                                    <div class="d-flex draggable"  id="row{{$index}}"  draggable="true" productID="{{$index}}">
                                                        <div class="col-lg-9 mt-lg-0">
                                                            <div class="card-body">
                                                                <select name="how_it_work_{{$index}}" id="how_it_work_{{$index}}" class="form-control how_it_work" data-index="{{$index}}">
                                                                    <option value="">Select Service</option>    
                                                                {!! sectionTemplateOptions('how_it_works', $data['how_it_work_'.$index]) !!}
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
                                                            <select name="how_it_work_0" id="how_it_work_0" class="form-control how_it_work" data-index="0">
                                                                <option value="">Select</option>    
                                                            {!!  sectionTemplateOptions('how_it_works')!!}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div><button class="btn btn-sm btn-danger mt-4 service_tabs_remove"><i class="fa fa-trash"></i></button></div>
                                                </div>
                                            @endif
                                        </div>
                                        <button class="btn btn-sm btn-secondary service_tabs_add_more" data-tag="how_it_work" type="button">Add More</button>
                                        <input type="hidden" id="how_it_work_count" name="how_it_work_count" value="{{$data['how_it_work_count'] ?? '1'}}">
                                        <input type="hidden" id="how_it_work_list" name="how_it_work_list"  value="{{$data['how_it_work_list'] ?? ''}}">
                                        
                                    </div>
                                    
                                </div>
                            <hr>
                            



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

            $('.how_it_work_list').append(`<div class="d-flex draggable" >
                                                      <div class="col-lg-9 mt-lg-0 ">
                                                          <div class="card-body">
                                                              <select name="how_it_work_0" id="how_it_work_0" class="form-control how_it_work">
                                                                  <option value="">Select Service</option> 
                                                                  <?php echo sectionTemplateOptions('how_it_works');?>
                                                              </select>
                                                          </div>
                                                      </div>
                                                       <div><button class="btn btn-sm btn-danger mt-4 service_tabs_remove"><i class="fa fa-trash"></i></button></div>
                                                  </div>`);
        }
      
                                            updateServiceSequance();
    });
    function updateServiceSequance(){
        let tag = 'how_it_work';
      
        $('.draggable').each(function(index, value){
            $(this).attr('id', 'row'+index).attr('productID', index);
            $(this).find('.'+tag).attr('name', tag+"_"+index).attr('id', tag+"_"+index).attr('data-index', index);
            
        });
        $('#how_it_work_count').val($('.'+tag).length);
        var values = [];
        $('.how_it_work').each(function(index, value){
            values.push($(this).val());
        }) 
        $('#how_it_work_list').val(JSON.stringify(values));
    }
    $(document).on('click', '.service_tabs_remove', function(e){
        $(this).parents().eq(1).remove();
        updateServiceSequance();
    });
    $(document).on('change', '.how_it_work', function(e){
       
        var services = $('#how_it_work_list').val();
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