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
                        <h5>Blogs</h5>
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
                                    <label class="form-label">Add Multiple</label>
                                    <div class="input-group">
                                        <select type="text" class="form-control" name="our_blogs_all_multiple" data-lable="our_blogs_all_multiple" id="our_blogs_all_multiple">
                                            @foreach(yesNoOption() as $item)
                                                <option value="{{$item['id'] ?? ''}}" @if(isset($data['our_blogs_all_multiple']) && ((gettype($data['our_blogs_all_multiple']) == 'string' && $data['our_blogs_all_multiple'] == $item['id'] ) || (gettype($data['our_blogs_all_multiple']) == 'array' && in_array($option['id'] , $data['our_blogs_all_multiple'])))) selected @endif>{{$item['name'] ?? ''}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <hr>
                                <div class="form-group">
                                    <label class="form-label"><strong>Services</strong></label>
                                    <div class="blog_list" id="sortable_product">
                                        @if(isset($data['blog_count']))
                                            @for($index = 0; $index < $data['blog_count']; $index++)
                                                <div class="d-flex draggable"  id="row{{$index}}"  draggable="true" productID="{{$index}}">
                                                    <div class="col-lg-9 mt-lg-0">
                                                        <div class="card-body">
                                                            <select name="blog_{{$index}}" id="blog_{{$index}}" class="form-control blog" data-index="{{$index}}">
                                                                <option value="">Select Blog</option>    
                                                            {!! blogOptions($data['blog_'.$index]) !!}
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
                                                        <select name="blog_0" id="blog_0" class="form-control blog" data-index="0">
                                                            <option value="">Select Blog</option>    
                                                        {!! blogOptions() !!}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div><button class="btn btn-sm btn-danger mt-4 service_tabs_remove"><i class="fa fa-trash"></i></button></div>
                                            </div>
                                        @endif
                                    </div>
                                    <button class="btn btn-sm btn-secondary service_tabs_add_more" data-tag="blog" type="button">Add More</button>
                                    <input type="hidden" id="blog_count" name="blog_count" value="{{$data['blog_count'] ?? '1'}}">
                                    <input type="hidden" id="blog_list" name="blog_list"  value="{{$data['blog_list'] ?? ''}}">

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

            $('.blog_list').append(`<div class="d-flex draggable" >
                                                        <div class="col-lg-9 mt-lg-0 ">
                                                            <div class="card-body">
                                                                <select name="blog_0" id="blog_0" class="form-control blog">
                                                                    <option value="">Select Blog</option> 
                                                                    <?php echo blogOptions();?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div><button class="btn btn-sm btn-danger mt-4 service_tabs_remove"><i class="fa fa-trash"></i></button></div>
                                                    </div>`);
        }
      
                                            updateServiceSequance();
    });
    function updateServiceSequance(){
        let tag = 'blog';
      
        $('.draggable').each(function(index, value){
            $(this).attr('id', 'row'+index).attr('productID', index);
            $(this).find('.'+tag).attr('name', tag+"_"+index).attr('id', tag+"_"+index).attr('data-index', index);
            
        });
        $('#blog_count').val($('.'+tag).length);
        var values = [];
        $('.blog').each(function(index, value){
            values.push($(this).val());
        }) 
        $('#blog_list').val(JSON.stringify(values));
    }
    $(document).on('click', '.service_tabs_remove', function(e){
        $(this).parents().eq(1).remove();
        updateServiceSequance();
    });
    $(document).on('change', '.blog', function(e){
       
        var services = $('#blog_list').val();
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