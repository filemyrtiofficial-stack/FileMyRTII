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
                        <h5>FAQS</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-12 faq-list">
                                <div class="card mt-3 faqs-card">
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
                                </div>
                            </div>
                        </div>
                        <div class="text-right mt-3">
                            <button type="button" class="btn btn-sm btn-secondary add-more">Add More</button>
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
</form>
@endsection
@push('js')
<script>
    $(document).on('click', '.add-more', function(e){
      
        $('.faq-list').append(`<div class="card mt-3 faqs-card">
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
                                </div>`);
        updateSequance();

    });
    $(document).on('click', '.remove-card', function(){
        $(this).parents().eq(2).remove();
        updateSequance();
    });
    function updateSequance() {
        let index = 0;
        $('.faqs-card').each(function(){
            $(this).find('.answer').attr('id', 'answer_'+index);
            $(this).find('.question').attr('id', 'question_'+index);
            index = index+1;

        });
        $(".editor").each(function(_, ckeditor) {
            CKEDITOR.replace(ckeditor);
        });

    }
</script>
@endpush
