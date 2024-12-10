<div class="row">
@foreach($blogs as $key => $value)
    @include('frontend.template.blog_card')

@endforeach
</div>