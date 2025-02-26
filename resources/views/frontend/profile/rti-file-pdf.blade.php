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
    @page { margin: 70px 50px 70px 50px; }
    #footer { position: fixed; left: 50%; bottom: -70px; right: 0px; text-align : "center"}
</style>
<div id="footer">
    <p class="page">{{$revision->rtiApplication->application_no}} </p>
    </div>
<div class="pdf-section">


<div class="title">
    <p><h3>{{$revision->serviceTemplate->title ?? ''}}</h3></p>
    <p><strong>{{$revision->serviceTemplate->sub_title}}</strong></p>
</div>

{!! $html!!}


<div class="signature">
  
{!! $signature_html !!}
    <!-- 

    <p><strong>Yours faithfully,</strong></p>
    <p><span class="text-span">{{$field_data['first_name']}} {{$field_data['last_name']}}</span></p>
    <p>Date: {{Carbon\Carbon::now()->format('d/m/Y')}}</p> -->
</div>




</div>
   

