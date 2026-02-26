
<html>
  <head>
      <style>
  
    @font-face {
        font-family: 'DancingScript';
            src: url('{{ storage_path("fonts/dancing_script.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
    }
    .signature span {
        font-family: "DancingScript", "cursive";
         font-size : 30px;
    }
 .signature {
     /*position: absolute;*/
     /*right: 0px;*/
     text-align: right;
 }
   
    .pdf-section {
        position: relative;
        font-family: 'DejaVu Sans', sans-serif;
    }
    .pdf-section .signature {
       position: absolute;
        right: 0px;
    }
    .pdf-section .title {
        text-align:center;
    }
    @page { margin: 70px 50px 70px 50px; 
       
    }
    #footer { position: fixed; left: 50%; bottom: -70px; right: 0px; text-align : "center"}
   
</style>
    <style>
      @page{
        margin-top: 100px; /* create space for header */
        margin-bottom: 70px; /* create space for footer */
      }
      header{
        position: fixed;
        left: 0px;
        right: 0px;
        height: 60px;
        margin-top: -60px;
      }
      footer{
        position: fixed;
        left: 0px;
        right: 0px;
        height: 50px;
        margin-bottom: -50px;
        bottom: 0px;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <header>
     
    </header>
    <footer>
      <p>Application No </p>
    </footer>
    <main>
        <div class="pdf-section">
            
        <div class="title">
    <p><h3>{{$service->templates[0]->title ?? ''}}</h3></p>
    <p><strong>{{$service->templates[0]->sub_title}}</strong></p>
</div>
        </div>

      {!! $html!!}


<div class="signature">

{!! $signature_html !!}
  
</div>

    </main>
  </body>
</html>
