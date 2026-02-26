@extends('frontend.layout.layout')

@section('content')

@php
    $hasFaq = false;
@endphp

@foreach($page_section as $key => $section)
    @if($section->section_key === 'faqs')
        @php $hasFaq = true; @endphp
    @endif
    <?php $data = json_decode($section->data, true); ?>
    @include('frontend.sections.' . $section->section_key)
@endforeach

@endsection

@section('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Service",
  "name": "{{ $service->name ?? 'RTI Filing Service' }}",
  "description": "{{ $seo->meta_description ?? 'Detailed RTI service for filing and tracking applications related to government, land, or personal matters in India.' }}",
  "provider": {
    "@type": "Organization",
    "name": "FileMyRTI",
    "url": "https://filemyrti.com",
    "logo": "https://filemyrti.com/assets/images/logo.webp"
  },
  "areaServed": {
    "@type": "Country",
    "name": "India"
  }
}
</script>

@if($hasFaq)
    @foreach($page_section as $section)
        @if($section->section_key === 'faqs')
            @php $faqData = json_decode($section->data, true); @endphp
            @if(!empty($faqData['question']) && !empty($faqData['answer']))
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    @foreach($faqData['question'] as $index => $question)
      {
        "@type": "Question",
        "name": "{{ $question }}",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "{{ strip_tags($faqData['answer'][$index] ?? '') }}"
        }
      }@if(!$loop->last),@endif
    @endforeach
  ]
}
</script>
            @endif
        @endif
    @endforeach
@endif

@endsection

@push('js')
@endpush
