@extends('layouts.app')

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Blog Management'])
<form method="POST"
    action="{{isset($data['id']) ? route('blogs.update', $data['id']) : route('blogs.store')}}"
    enctype="multipart/form-data" class="form-submit" method="post">
    @csrf
    @if(isset($data['id']))
    <input type="hidden" name="_method" value="PUT">
    @endif
 
    <div class="d-flex justify-content-center mb-5">
      <div class="row col-lg-12">

          <div class="col-lg-8 mt-lg-0 mt-4">
              <div class="card mt-4">
                  <div class="card-header">
                      <h5>{{isset($data['id']) ? 'Edit' : 'New'}} Blog</h5>
                  </div>
                  <div class="card-body pt-0">
                          <div class="row mt-5">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Name</label>
                                        <div class="input-group">
                                            <input id="title" name="title" value="{{$data['title'] ?? ''}}" class="form-control"
                                                type="text" placeholder="title">
                                        </div>
                                        </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Short Description</label>
                                        <div class="input-group">
                                            <textarea id="short_description" name="short_description" class="form-control"
                                                type="text" placeholder="short description">{{$data['short_description'] ?? ''}}</textarea>
                                        </div>
                                    </div>
                                </div>
  
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="form-label">Description</label>
                                        <div class="input-group">
                                            <textarea id="description" name="description" class="form-control editor"
                                                type="text" placeholder="description">{{$data['description'] ?? ''}}</textarea>
                                        </div>
                                    </div>
                                </div>
  
                            
  
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label">Category</label>
                                        <div class="input-group">
                                            <select name="category[]" multiple id="category" class="form-control select-2">
                                                @foreach($categories as $key => $item)
                                                <option value="{{$item->id}}" @if(isset($category_ids) && in_array($item->id, $category_ids)) selected @endif>
                                                    {{$item['name']}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
  
                              
                            
                          </div>
                         
                        
                        
                  </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                      <h5>Blog Images</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mt-5">
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Thumbnail</label>
                                    <div class="input-group">
                                        <input name="thumbnail" type="file" class="form-control dropify" id="thumbnail" @if(isset($data)) data-default-file="{{ asset($data->thumbnail) }}" @endif>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Feature Image</label>
                                    <div class="input-group">
                                        <input name="feature_image" type="file" class="form-control dropify" id="feature_image"  @if(isset($data)) data-default-file="{{ asset($data->banner) }}" @endif>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header">
                      <h5>Blog FAQ</h5>
                    </div>
                    <div class="card-body pt-0">
                    <div class="table-responsive">
                              <table class="table">
                                  <thead>
                                      <tr>
                                          <th>Question</th>
                                          <th>Answer</th>
                                          <th></th>
                                      </tr>
                                  </thead>
                                  <tbody id="faq-list">
                                    @if(!isset($data))
                                      <tr>
                                          <th><textarea name="question[]" class="form-control" id="" required></textarea></th>
                                          <th><textarea name="answer[]" class="form-control" id="" required></textarea></th>
                                          <th><button class="btn btn-sm btn-danger remove-faq-item" type="button"><i
                                          class="fa fa-trash"></i></button></th>
  
                                      </tr>
                                      @else
                                        @foreach($data->blogFaqs ?? [] as $faq)
                                            <tr>
                                                <th><textarea name="question[]" class="form-control" id="" required>{{$faq->question}}</textarea></th>
                                                <th><textarea name="answer[]" class="form-control" id="" required>{{$faq->answer}}</textarea></th>
                                                <th><button class="btn btn-sm btn-danger remove-faq-item" type="button"><i
                                                class="fa fa-trash"></i></button></th>
                                            </tr>
                                        @endforeach
                                      @endif
                                  </tbody>
                              </table>
                              <button class="btn btn-sm btn-secondary add-more-faq" type="button">Add More Faq</button>
                          </div>
                    </div>
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
                                        <input id="slug" name="slug" value="{{$data->slug ?? ''}}" class="form-control"
                                            type="text" placeholder="slug">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Publish Date</label>
                                    <div class="input-group">
                                        <input id="publish_date" name="publish_date" value="{{$data['publish_date'] ?? ''}}" class="form-control"
                                            type="date" placeholder="publish_date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <div class="input-group">
                                        <select name="status" id="status" class="form-control">
                                            @foreach(blogStatus() as $key => $item)
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
                        <div class="mt-5 float-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                  </div>
              </div>
          </div>
         
      </div>
    </div>
</form>

@endsection
@push('js')
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