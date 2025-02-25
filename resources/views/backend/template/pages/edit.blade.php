@extends('layouts.app')
@section('breadcrumbs')

<li class="breadcrumb-item" aria-current="page"><a href="{{route('pages.index')}}">Page Management</a></li>

<li class="breadcrumb-item active" aria-current="page">Edit</li>

@endsection
@section('content')
<style>
    ul.accordion-list {
	 position: relative;
	 display: block;
	 width: 100%;
	 height: auto;
	 padding: 20px;
	 margin: 0;
	 list-style: none;
	 background-color: #f9f9fa;
}
 ul.accordion-list li {
	 position: relative;
	 display: block;
	 width: 100%;
	 height: auto;
	 background-color: #fff;
	 padding: 20px;
	 margin: 0 auto 15px auto;
	 border: 1px solid #eee;
	 border-radius: 5px;
	 cursor: pointer;
}
 ul.accordion-list li.active h3:after {
	 transform: rotate(45deg);
}
 ul.accordion-list li h3 {
	 font-weight: 700;
	 position: relative;
	 display: block;
	 width: 100%;
	 height: auto;
	 padding: 0 0 0 0;
	 margin: 0;
	 font-size: 15px;
	 letter-spacing: 0.01em;
	 cursor: pointer;
}
 ul.accordion-list li h3:after {
	 content: "\f278";
	 font-family: "material-design-iconic-font";
	 position: absolute;
	 right: 0;
	 top: 0;
	 color: #fcc110;
	 transition: all 0.3s ease-in-out;
	 font-size: 18px;
}
 ul.accordion-list li div.answer {
	 position: relative;
	 display: block;
	 width: 100%;
	 height: auto;
	 margin: 0;
	 padding: 0;
	 cursor: pointer;
}
 ul.accordion-list li div.answer p {
	 position: relative;
	 display: block;
	 font-weight: 300;
	 padding: 10px 0 0 0;
	 cursor: pointer;
	 line-height: 150%;
	 margin: 0 0 15px 0;
	 font-size: 14px;
}
 
</style>
@include('layouts.navbars.auth.topnav', ['title' => 'Page Management'])
<form method="POST"
    action="{{isset($data['id']) ? route('pages.update', $data['id']) : route('pages.store')}}"
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
                      <h5>{{isset($data['id']) ? 'Edit' : 'New'}} Page</h5>
                  </div>
                  <div class="card-body pt-0">
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <div class="input-group">
                                        <input id="title" name="title" value="{{$data['title'] ?? ''}}" class="form-control enable-slug"
                                            type="text" placeholder="title">
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

                            
                            
                        </div>
                  </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">
                      <h5>Section List</h5>
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sectionSelectionModalCenter">Select Section</button>
                    </div>
                    <div class="card-body pt-0">
                        <div class=" mt-5">
                        <div class="accordion" id="sortable_product">
                          @foreach($data->getData ?? [] as $key => $item)
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
                                  <a href="{{route('get-page-section',[$data->id, $item->section_key, $item->id])}}" class="btn btn-sm btn-secondary">Edit</a>
                                  <button href="{{route('delete-page-section',[$item->id])}}" class="btn btn-sm btn-danger ml-3 delete-btn">Delete</button>

                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>

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
                                        <input id="slug" name="slug" value="{{$data->slugMaster->slug ?? ''}}" class="form-control"
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
                        <div class="mt-5 float-right">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                  </div>
              </div>
          </div>
         
      </div>
    </div>
    <input type="text" id="update_array" name="update_array" hidden>
    <!-- <input type="file" id="file_upload" name="file_upload[]" multiple> -->

</form>



<!-- Button trigger modal -->


<!-- Modal -->
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
                
              <a href="{{route('get-page-section', [$data->id, $key])}}">
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





@endsection
@push('js')

@endpush