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
    <p><h3>The Right to Information Act, 2005</h3></p>
    <p><strong>Application for Obtaining Information</strong></p>
</div>

{!! $template->template !!}


<div class="signature">
    <p>[Insert E-Signature]</p>
    <p><strong>Yours faithfully,</strong></p>
    <p><span class="text-span">[first_name] [last_name]</span></p>
    <p>Date: {{Carbon\Carbon::now()->format('d/m/Y')}}</p>
</div>




</div>
   

