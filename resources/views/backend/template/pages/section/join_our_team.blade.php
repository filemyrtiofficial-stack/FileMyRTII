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
                        <h5>Join Our Team</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                <label class="form-label">Title</label>
                                    <div class="input-group">
                                    <input type="text" class="form-control" value="{{$data['title'] ?? ''}}" name="title" id="title" required>

                                    </div>
                                </div>
                           

                          
                            <div class="col-12">
                                    <hr>
                                    <div class="form-group">
                                        <label class="form-label"><strong>Services</strong></label> (<span class="text-danger">Note : You can add only 4 list</span>)
                                        <div class="join_our_team_list" id="sortable_product">
                                            @if(isset($data['join_our_team_count']))
                                                @for($index = 0; $index < $data['join_our_team_count']; $index++)
                                                    <div class="d-flex draggable"  id="row{{$index}}"  draggable="true" productID="{{$index}}">
                                                        <div class="col-lg-9 mt-lg-0">
                                                            <div class="card-body">
                                                                <select name="join_our_team_{{$index}}" id="join_our_team_{{$index}}" class="form-control join_our_team" data-index="{{$index}}">
                                                                    <option value="">Select Service</option>    
                                                                {!! sectionTemplateOptions('join_our_team', $data['join_our_team_'.$index]) !!}
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
                                                            <select name="join_our_team_0" id="join_our_team_0" class="form-control join_our_team" data-index="0">
                                                                <option value="">Select</option>    
                                                            {!!  sectionTemplateOptions('join_our_team')!!}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div><button class="btn btn-sm btn-danger mt-4 service_tabs_remove"><i class="fa fa-trash"></i></button></div>
                                                </div>
                                            @endif
                                        </div>
                                        <button class="btn btn-sm btn-secondary service_tabs_add_more" data-tag="join_our_team" type="button">Add More</button>
                                        <input type="hidden" id="join_our_team_count" name="join_our_team_count" value="{{$data['join_our_team_count'] ?? '1'}}">
                                        <input type="hidden" id="join_our_team_list" name="join_our_team_list"  value="{{$data['join_our_team_list'] ?? ''}}">
                                        
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
        if($('.draggable').length < 4) {

            $('.join_our_team_list').append(`<div class="d-flex draggable" >
                                                      <div class="col-lg-9 mt-lg-0 ">
                                                          <div class="card-body">
                                                              <select name="join_our_team_0" id="join_our_team_0" class="form-control join_our_team">
                                                                  <option value="">Select Service</option> 
                                                                  <?php echo sectionTemplateOptions('join_our_team');?>
                                                              </select>
                                                          </div>
                                                      </div>
                                                       <div><button class="btn btn-sm btn-danger mt-4 service_tabs_remove"><i class="fa fa-trash"></i></button></div>
                                                  </div>`);
        }
      
                                            updateServiceSequance();
    });
    function updateServiceSequance(){
        let tag = 'join_our_team';
      
        $('.draggable').each(function(index, value){
            $(this).attr('id', 'row'+index).attr('productID', index);
            $(this).find('.'+tag).attr('name', tag+"_"+index).attr('id', tag+"_"+index).attr('data-index', index);
            
        });
        $('#join_our_team_count').val($('.'+tag).length);
        var values = [];
        $('.join_our_team').each(function(index, value){
            values.push($(this).val());
        }) 
        $('#join_our_team_list').val(JSON.stringify(values));
    }
    $(document).on('click', '.service_tabs_remove', function(e){
        $(this).parents().eq(1).remove();
        updateServiceSequance();
    });
    $(document).on('change', '.join_our_team', function(e){
       
        var services = $('#join_our_team_list').val();
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