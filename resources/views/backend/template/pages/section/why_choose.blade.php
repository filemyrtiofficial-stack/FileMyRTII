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
                        <h5>Why Choose</h5>
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
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <div class="input-group">
                                        <textarea type="text" class="form-control" name="description" data-lable="description" id="description">{{$data['description'] ?? ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Add Multiple</label>
                                    <div class="input-group">
                                        <select type="text" class="form-control" name="our_why_choose_all_multiple" data-lable="our_why_choose_all_multiple" id="our_why_choose_all_multiple">
                                            @foreach(yesNoOption() as $item)
                                                <option value="{{$item['id'] ?? ''}}" @if(isset($data['our_why_choose_all_multiple']) && ((gettype($data['our_why_choose_all_multiple']) == 'string' && $data['our_why_choose_all_multiple'] == $item['id'] ) || (gettype($data['our_why_choose_all_multiple']) == 'array' && in_array($option['id'] , $data['our_why_choose_all_multiple'])))) selected @endif>{{$item['name'] ?? ''}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-12">
                                <hr>
                                <div class="form-group">
                                    <label class="form-label"><strong>List</strong></label>
                                    <div class="why_chooselist" id="sortable_product">
                                       
                                        @if(isset($data['why_choosecount']))
                                            @for($index = 0; $index < $data['why_choosecount']; $index++)
                                                @if(isset($data['why_choose_'.$index]))
                                                    <div class="d-flex draggable"  id="row{{$index}}"  draggable="true" productID="{{$index}}">
                                                        <div class="col-lg-9 mt-lg-0">
                                                            <div class="card-body">
                                                                <select name="why_choose{{$index}}" id="why_choose_{{$index}}" class="form-control why_choose data-index="{{$index}}">
                                                                    <option value="">Select </option>    
                                                                {!! sectionTemplateOptions('why_choose',$data['why_choose_'.$index]) !!}
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
                                                        <select name="why_choose0" id="why_choose0" class="form-control why_choose data-index="0">
                                                            <option value="">Select</option>    
                                                        {!! sectionTemplateOptions('why_choose') !!}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div><button class="btn btn-sm btn-danger mt-4 service_tabs_remove"><i class="fa fa-trash"></i></button></div>
                                            </div>
                                        @endif
                                    </div>
                                    <button class="btn btn-sm btn-secondary service_tabs_add_more" data-tag="why_choose" type="button">Add More</button>
                                    <input type="hidden" id="why_choosecount" name="why_choosecount" value="{{$data['why_choosecount'] ?? '1'}}">
                                    <input type="hidden" id="why_chooselist" name="why_chooselist"  value="{{$data['why_chooselist'] ?? ''}}">

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

            $('.why_chooselist').append(`<div class="d-flex draggable" >
                                                        <div class="col-lg-9 mt-lg-0 ">
                                                            <div class="card-body">
                                                                <select name="why_choose0" id="why_choose0" class="form-control why_choose">
                                                                    <option value="">Select </option> 
                                                                    <?php echo sectionTemplateOptions('why_choose');?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div><button class="btn btn-sm btn-danger mt-4 service_tabs_remove"><i class="fa fa-trash"></i></button></div>
                                                    </div>`);
        }
      
                                            updateServiceSequance();
    });
    function updateServiceSequance(){
        let tag = 'why_choose';
      
        $('.draggable').each(function(index, value){
            $(this).attr('id', 'row'+index).attr('productID', index);
            $(this).find('.'+tag).attr('name', tag+"_"+index).attr('id', tag+"_"+index).attr('data-index', index);
            
        });
        $('#why_choosecount').val($('.'+tag).length);
        var values = [];
        $('.why_choose').each(function(index, value){
            values.push($(this).val());
        }) 
        $('#why_chooselist').val(JSON.stringify(values));
    }
    $(document).on('click', '.service_tabs_remove', function(e){
        $(this).parents().eq(1).remove();
        updateServiceSequance();
    });
    $(document).on('change', '.why_choose', function(e){
       
        var services = $('#why_chooselist').val();
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