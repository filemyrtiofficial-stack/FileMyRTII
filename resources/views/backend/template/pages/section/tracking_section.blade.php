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
                        <h5>Track My RTI</h5>
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
    $(document).on('click', '.add-more-breaddrum', function(e){
        $('#add-more-breaddrum-list').append(`  <tr>
                                            <td><input type="text" class="form-control" name="breadcrum_label[]"></td>
                                            <td><input type="text" class="form-control" name="breadcrum_url[]"></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger remove-breadcrum"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>`);
    });
    $(document).on('click', '.remove-breadcrum', function(e){
        $(this).parents().eq(1).remove();
    });
</script>
@endpush