<style>
  
    .pdf-section {
        position: relative;
    }
    .pdf-section .signature {
       position: absolute;
        right: 0px;
    }
    .pdf-section .title {
        text-align:center;
    }

</style>
<div class="pdf-section">


<div class="title">
    <p><h3>{{$service->templates[0]->title ?? ''}}</h3></p>
    <p><strong>{{$service->templates[0]->sub_title}}</strong></p>
</div>

{!! $service->templates[0]->template ?? ''!!}


<div class="signature">
  
</p>

    <p><strong>Yours faithfully,</strong></p>
    <p><span class="text-span">[first_name] [last_name]</span></p>
    <p>Date: {{Carbon\Carbon::now()->format('d/m/Y')}}</p>
</div>




</div>
   

