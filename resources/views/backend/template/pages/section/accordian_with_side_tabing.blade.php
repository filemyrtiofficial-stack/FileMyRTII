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
                        <h5>FAQS</h5>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                                <div class="form-group">
                                        <label class="form-label">Title</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" value="{{$data['title'] ?? ''}}" name="title" id="title">
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class=" category-list">

                        @if(!empty($id)) 
                            @foreach($data['category'] as $key =>  $value)
                            <div class="card-body pt-0">
                                <div class="category-list-item" id="category-list-item-0">

                                        <div class="card mt-3 category-card">
                                            <div class="card-header">
                                                <div class="form-group">
                                                        <label class="form-label">Category</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control category" value="{{$value}}" name="category[]" id="category_{{$key}}">
                                                    </div>
                                                </div>
                                                 <div class="form-group">
                                                        <label class="form-label">Subtitle</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control subtitle" value="{{$data['subtitle'][$key] ?? ''}}" name="subtitle[]" id="subtitle_{{$key}}">
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                        <button class="btn btn-sm btn-danger remove-category-card" type="button">Remove</button>
                                                    </div>
                                            </div>
                                            <div class="category-faq">
                                            @foreach($data['answer_'.$key] as $answer_key =>  $answer_value)
                                                <div class="category-faq-item">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                                <label class="form-label">Question</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control question"  name="question_{{$key}}[]" id="question_{{$key}}_{{$answer_key}}" value="{{$data['question_'.$key][$answer_key] ?? ''}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                                <label class="form-label">Answer</label>
                                                                <div class="input-group">
                                                                    <textarea type="text" class="form-control answer editor"  name="answer_{{$key}}[]" id="answer_{{$key}}_{{$answer_key}}">{{$answer_value}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer text-right">
                                                        <button class="btn btn-sm btn-danger remove-card" type="button">Remove</button>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            
                                        </div>
                                    
                                </div>
                                <div class="text-right mt-3">
                                    <button type="button" class="btn btn-sm btn-secondary add-more" data-type="faq" data-target="category-list-item-0">Add More</button>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="card-body pt-0">
                                <div class="category-list-item" id="category-list-item-0">

                                        <div class="card mt-3 category-card">
                                            <div class="card-header">
                                                <div class="form-group">
                                                        <label class="form-label">Category</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control category"  name="category[]" id="category_0">
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <button class="btn btn-sm btn-danger remove-category-card" type="button">Remove</button>
                                                </div>
                                            </div>
                                            <div class="category-faq">
        
                                                <div class="category-faq-item">
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                                <label class="form-label">Question</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control question"  name="question_0[]" id="question_0_0">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                                <label class="form-label">Answer</label>
                                                                <div class="input-group">
                                                                    <textarea type="text" class="form-control answer editor"  name="answer_0[]" id="answer_0_0"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-footer text-right">
                                                        <button class="btn btn-sm btn-danger remove-card" type="button">Remove</button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    
                                </div>
                                <div class="text-right mt-3">
                                    <button type="button" class="btn btn-sm btn-secondary add-more" data-type="faq" data-target="category-list-item-0">Add More</button>
                                </div>
                            </div>
                        @endif
                     

                    </div>
    
                </div>
                    <div class="mt-5 float-right">
                    <button type="button" class="btn btn-secondary add-more" data-type="category">Add More Category</button>

                        <button class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@push('js')
<script>
    $(document).on('click', '.add-more', function(e){
        let type = $(this).attr('data-type');
        let card =`<div class="category-faq-item">
                        <div class="card-body">
                        <div class="form-group">
                                <label class="form-label">Question</label>
                                <div class="input-group">
                                    <input type="text" class="form-control question"  name="question[]" id="question_0">
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="form-label">Answer</label>
                                <div class="input-group">
                                    <textarea type="text" class="form-control answer editor"  name="answer[]" id="answer_0"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-sm btn-danger remove-card" type="button">Remove</button>
                    </div>
                    </div>`;
        if(type == 'faq') {
            let target = $(this).attr('data-target')
            // $('#'+target).find('.category-faq').append(card);
            $(this).parents().eq(1).find('.category-faq').append(card);

        }
        else {
            $('.category-list').append(` <div class="card-body pt-0 category-list-item">
                        <div class="row">

                            <div class="col-12 ">
                                <div class="card mt-3 category-card">
                                    <div class="card-header">
                                        <div class="form-group">
                                                <label class="form-label">Category</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control category"  name="category[]" id="category_0">
                                            </div>
                                        </div>
                                          <div class="form-group">
                                                <label class="form-label">Subtitle</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control subtitle" name="subtitle[]" id="subtitle_0">
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <button class="btn btn-sm btn-danger remove-category-card" type="button">Remove</button>
                                        </div>
                                    </div>
                                    <div class="category-faq">

                                        ${card}
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="text-right mt-3">
                            <button type="button" class="btn btn-sm btn-secondary add-more" data-type="faq">Add More</button>
                        </div>
                    </div>
    `)
        }
        
        updateSequance();

    });

    $(document).on('click', '.remove-card', function(){
        $(this).parents().eq(1).remove();
        updateSequance();
    });

    $(document).on('click', '.remove-category-card', function(){
        $(this).parents().eq(4).remove();
        updateSequance();
    });
    
    function updateSequance() {
        let index = 0;
        $('.category-list-item').each(function(){
            $(this).attr('id', 'category-list-item-'+index);
            $(this).find('.category').attr('id', 'category_'+index);
            $(this).find('.subtitle').attr('id', 'subtitle_'+index);


            $(this).find('.add-more').attr('data-target', 'category-list-item-'+index);
            var child_index = 0;
            $('#category-list-item-'+index+' .category-faq-item').each(function(){
                $(this).find('.answer').attr('name', 'answer_'+index+"[]").attr('id', 'answer_'+index+"_"+child_index);
                $(this).find('.question').attr('name', 'question_'+index+"[]").attr('id', 'question_'+index+"_"+child_index);
                child_index = child_index+1;
            });
            index = index+1;
        });
        $(".editor").each(function(_, ckeditor) {
            CKEDITOR.replace(ckeditor);
        });
        // let index = 0;
        // $('.faqs-card').each(function(){
        //     $(this).find('.answer').attr('id', 'answer_'+index);
        //     $(this).find('.question').attr('id', 'question_'+index);
        //     index = index+1;

        // });
    }
</script>
@endpush
