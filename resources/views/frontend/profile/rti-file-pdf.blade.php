<div>
 <style>
    /* body {
        height: 842px;
        width: 595px;
        margin-left: auto;
        margin-right: auto;
        position: relative;
    } */
    .signature {
        position: absolute;
    right: 0px;
    }
    .title {
        text-align:center;
    }
    /* .text-span {
        display:none;
    } */
</style>


<div class="title">
    <p><h3>{{$revision->serviceTemplate->title ?? ''}}</h3></p>
    <p><strong>{{$revision->serviceTemplate->sub_title}}</strong></p>
</div>

{!! $html!!}


<div class="signature">
    <p><img src="{{$signature}}" alt="" width="100"></p>
    <p><strong>Yours faithfully,</strong></p>
    <p><span class="text-span">{{$field_data['first_name']}} {{$field_data['last_name']}}</span></p>
    <p>Date: {{Carbon\Carbon::now()->format('d/m/Y')}}</p>
</div>




</div>
   

