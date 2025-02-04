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
    <p><h3>{{$revision->serviceTemplate->title ?? ''}}</h3></p>
    <p><strong>{{$revision->serviceTemplate->sub_title}}</strong></p>
</div>

{!! $html!!}


<div class="signature">
    <p>
    @if($data->signature_type == 'manual')
    <span>{{$data->signature_image}}</span>
    @else    
    <img src="{{$signature}}" alt="" width="100">
    @endif
</p>

    <p><strong>Yours faithfully,</strong></p>
    <p><span class="text-span">{{$field_data['first_name']}} {{$field_data['last_name']}}</span></p>
    <p>Date: {{Carbon\Carbon::now()->format('d/m/Y')}}</p>
</div>




</div>
   

