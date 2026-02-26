

<html>
  <head>
      <style>
  
    @font-face {
          font-family: 'Zeyada';
            src: url('{{ storage_path("fonts/Zeyada-Regular.ttf") }}') format('truetype');
        /*font-family: 'DancingScript';*/
        /*      src: url('{{ storage_path("fonts/greatvibes-regular.ttf") }}') format('truetype');*/
            font-weight: normal;
            font-style: normal;
    }
    .signature span {
         font-family: 'Zeyada', cursive; 
        /*font-family: "DancingScript", "cursive";*/
         font-size : 20px;
         /*color : #0b57d0;*/
            color : #1a237e;
            opacity: 0.9;
letter-spacing: 0.3px;
         
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
      <p>{{$revision->rtiApplication->application_no}} </p>
    </footer>
    <main>
        <div class="pdf-section">
            
        <div class="title">
    <p><h3>{{$revision->serviceTemplate->title ?? ''}}</h3></p>
    <p><strong>{{$revision->serviceTemplate->sub_title}}</strong></p>
</div>
        </div>

      {!! $html!!}


<div class="signature">

{!! $signature_html !!}
  
</div>

    </main>
  </body>
</html>


