@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Service Management'])
<style>
    .hide {
        display:none;
    }
</style>
<form method="POST" action="{{isset($data['id']) ? route('service-category.update', $data['id']) : route('service-category.store')}}" enctype="multipart/form-data" class="form-submit" method="post">
    @csrf
    @if(isset($data['id']))
    <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="d-flex justify-content-center mb-5">
        <div class="row col-lg-12">
            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card mt-4">
                    <div class="card-header">
                        <h4>{{isset($data['id']) ? 'Edit' : 'New'}} Service</h4>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <div class="input-group">
                                        <input id="name" name="name" value="{{$data['name'] ?? ''}}" class="form-control enable-slug"
                                        type="text" placeholder="Name">
                                    </div>
                                </div>
                            </div>
                            
                          
                        </div>
                    </div>
                </div>
                @if(isset($data))
                <div class="card mt-4">
                    <div class="card-header">
                      <h5>Section List</h5>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sectionSelectionModalCenter">Select Section</button>
                    </div>
                    <div class="card-body pt-0">
                        <div class=" mt-5">
                        <div class="accordion" id="sortable_product">
                          @foreach($data->serviceData ?? [] as $key => $item)
                            <?php
                            $item_data = templateList()[$item->section_key] ?? [];
                            $details = json_decode($item->data, true);
                            ?>
                            <div class="card draggable"  id="row{{  $item->id }}"  draggable="true" productID="{{ $item->id}}">
                              <div class="card-header" id="headingOne" style="background: #e3e3e3;;">
                                <h2 class="mb-0">
                                      <strong>{{$item_data['section_name'] ?? ''}} </strong>
                                </h2>
                                  <h4>({!! $details['title'] ?? '' !!})</h4>
                                <div class="accordian-actions">
                                  <a href="{{route('get-service-category-section',[$data->id, $item->section_key, $item->id])}}" class="btn btn-sm btn-secondary">Edit</a>
                                  <button href="{{route('delete-services-section',[$item->id])}}" class="btn btn-sm btn-danger ml-3 delete-btn">Delete</button>

                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>

                        </div>
                    </div>
                </div>
                @endif
             
                <div class="mt-5 text-right">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
            <div class="col-lg-4">
              <div class="card mt-4">
                    <div class="card-header">
                      <h5>SEO Details</h5>
                    </div>
                  <div class="card-body pt-0">
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Slug</label>
                                    <div class="input-group">
                                        <input id="slug" name="slug" value="{{$data->slug->slug ?? ''}}" class="form-control"
                                            type="text" placeholder="slug">
                                    </div>
                                </div>
                            </div>
                         
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <div class="input-group">
                                        <select name="status" id="status" class="form-control">
                                            @foreach(commonStatus() as $key => $item)
                                            <option value="{{$key}}" @if(isset($data['status']) && $data['status']==$key)
                                                selected @endif>
                                                {{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-3">
                            <h5 class="ml-2">Meta Details</h5>
                            <hr>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Title</label>
                                    <div class="input-group">
                                        <input id="meta_title" name="meta_title" value="{{$data->seo->meta_title ?? ''}}" class="form-control"
                                            type="text" placeholder="meta_title">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Keywords</label>
                                    <div class="input-group">
                                        <input id="meta_keywords" name="meta_keywords" value="{{$data->seo->meta_keywords ?? ''}}" class="form-control"
                                            type="text" placeholder="meta_keywords">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Description</label>
                                    <div class="input-group">
                                        <textarea id="meta_description" name="meta_description" class="form-control"
                                            type="text" placeholder="meta_description">{{$data->seo->meta_description ?? ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="mt-5 float-right">
                            <button class="btn btn-primary">Submit</button>
                        </div> -->
                  </div>
              </div>
              
              
          </div>
        </div>
        
    </div>  
    <input type="text" id="update_array" name="update_array" hidden>

</form>



<!-- Modal -->
 @if(isset($data))
<div class="modal fade" id="sectionSelectionModalCenter" tabindex="-1" role="dialog" aria-labelledby="sectionSelectionModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Section List</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          @foreach(templateList() as $key => $section)
          <div class="col-md-3 mb-3"  >

            <div class="card add-section1" data-key="{{$key}}" data-name="{{$section['section_name']}}">
              <div class="card-header p-0">
              <img src="{{asset('assets/section/'.$key.'.png')}}" class="w-100">

              </div>
              <div class="card-body">
                
              <a href="{{route('get-service-category-section', [$data->id, $key])}}">
              {{$section['section_name']}}
            </a>

              </div>
            </div>
          </div>
          @endforeach
        </div>
                                        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endif
@endsection
@push('js')
<script>
    $(document).on('click', '.add-more', function(e){
        console.log(
            '{{fieldListOptions()}}'
        )
        $('.field-list').append(`  <div class="col-md-12">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="form-group hide">
                                        <label for="">Field Type</label> <br>
                                        <div class="input-group">
                                        <select type="text" name="field_type[]" class="form-control" required>
                                                    <?php echo fieldListOptions(); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Field Lable</label> <br>
                                        <div class="input-group">
                                            <input type="text" name="field_lable[]" class="form-control" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="">Is Required</label> <br>
                                        <div class="input-group">
                                            <select type="text" name="is_required[]" class="form-control" required>
                                            <?php echo booleanListOptions(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-sm btn-danger remove-card" type="button">Remove</button>
                                </div>
                            </div>
                        </div>`);
    });
    $(document).on('click', '.remove-card', function(){
        $(this).parents().eq(2).remove();
    })
</script>
<script>
    $(document).on('click', '.remove-faq-item', function() {
        $(this).parents().eq(1).remove();
    });
    $(document).on('click', '.add-more-faq', function(e) {
    
    $('#faq-list').append(`<tr>
                                <th><textarea name="question[]" class="form-control" id="" required></textarea></th>
                                    <th><textarea name="answer[]" class="form-control" id="" required></textarea></th>
                                    <th><button class="btn btn-sm btn-danger remove-faq-item" type="button"><i
                                    class="fa fa-trash"></i></button></th>
                            </tr>`);
})
    </script>
@endpush