@extends('layouts.app')

@section('content')
<style>
    ul.accordion-list {
	 position: relative;
	 display: block;
	 width: 100%;
	 height: auto;
	 padding: 20px;
	 margin: 0;
	 list-style: none;
	 background-color: #f9f9fa;
}
 ul.accordion-list li {
	 position: relative;
	 display: block;
	 width: 100%;
	 height: auto;
	 background-color: #fff;
	 padding: 20px;
	 margin: 0 auto 15px auto;
	 border: 1px solid #eee;
	 border-radius: 5px;
	 cursor: pointer;
}
 ul.accordion-list li.active h3:after {
	 transform: rotate(45deg);
}
 ul.accordion-list li h3 {
	 font-weight: 700;
	 position: relative;
	 display: block;
	 width: 100%;
	 height: auto;
	 padding: 0 0 0 0;
	 margin: 0;
	 font-size: 15px;
	 letter-spacing: 0.01em;
	 cursor: pointer;
}
 ul.accordion-list li h3:after {
	 content: "\f278";
	 font-family: "material-design-iconic-font";
	 position: absolute;
	 right: 0;
	 top: 0;
	 color: #fcc110;
	 transition: all 0.3s ease-in-out;
	 font-size: 18px;
}
 ul.accordion-list li div.answer {
	 position: relative;
	 display: block;
	 width: 100%;
	 height: auto;
	 margin: 0;
	 padding: 0;
	 cursor: pointer;
}
 ul.accordion-list li div.answer p {
	 position: relative;
	 display: block;
	 font-weight: 300;
	 padding: 10px 0 0 0;
	 cursor: pointer;
	 line-height: 150%;
	 margin: 0 0 15px 0;
	 font-size: 14px;
}
 
</style>
@include('layouts.navbars.auth.topnav', ['title' => 'Page Management'])
<form method="POST"
    action="{{isset($data['id']) ? route('pages.update', $data['id']) : route('pages.store')}}"
    enctype="multipart/form-data" class="form-submit" method="post">
    @csrf
    @if(isset($data['id']))
    <input type="hidden" name="_method" value="PUT">
    @endif
 
    <div class="d-flex justify-content-center mb-5">
      <div class="row col-lg-12">

          <div class="col-lg-8 mt-lg-0 mt-4">
              <div class="card mt-4">
                  <div class="card-header">
                      <h5>{{isset($data['id']) ? 'Edit' : 'New'}} Page</h5>
                  </div>
                  <div class="card-body pt-0">
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <div class="input-group">
                                        <input id="title" name="title" value="{{$data['title'] ?? ''}}" class="form-control"
                                            type="text" placeholder="title">
                                    </div>
                                    </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Description</label>
                                    <div class="input-group">
                                        <textarea id="description" name="description" class="form-control editor"
                                            type="text" placeholder="description">{{$data['description'] ?? ''}}</textarea>
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                  </div>
                </div>
             

          </div>
         
          <div class="col-lg-4">
              <div class="card mt-4">
                    <div class="card-header">
                      <h5>SEO Details</h5>
                    </div>
                  <div class="card-body pt-0">
                        <div class="row mt-5">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Slug</label>
                                    <div class="input-group">
                                        <input id="slug" name="slug" value="{{$data->slugMaster->slug ?? ''}}" class="form-control"
                                            type="text" placeholder="slug">
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Status</label>
                                    <div class="input-group">
                                        <select name="status" id="status" class="form-control">
                                            @foreach(commonStatus() as $key => $item)
                                            <option value="{{$key}}" @if(isset($data['status']) && $data['status']==$key)
                                                selected @endif>
                                                {{$item['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr class="mt-3">
                            <h5 class="ml-2">Meta Details</h5>
                            <hr>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Title</label>
                                    <div class="input-group">
                                        <input id="meta_title" name="meta_title" value="{{$data->seo->meta_title ?? ''}}" class="form-control"
                                            type="text" placeholder="meta_title">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Keywords</label>
                                    <div class="input-group">
                                        <input id="meta_keywords" name="meta_keywords" value="{{$data->seo->meta_keywords ?? ''}}" class="form-control"
                                            type="text" placeholder="meta_keywords">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Meta Description</label>
                                    <div class="input-group">
                                        <textarea id="meta_description" name="meta_description" class="form-control"
                                            type="text" placeholder="meta_description">{{$data->seo->meta_description ?? ''}}</textarea>
                                    </div>
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
    </div>
    <!-- <input type="file" id="file_upload" name="file_upload[]" multiple> -->

</form>
<!-- 
<form class="dropzone needsclick" id="demo-upload" action="{{route('upload-images')}}">
      <DIV class="dz-message needsclick">    
        Drop files here or click to upload.<BR>
        <SPAN class="note needsclick">(This is just a demo dropzone. Selected 
        files are <STRONG>not</STRONG> actually uploaded.)</SPAN>
      </DIV>
</form>

<form method="POST"
    action="{{isset($data['id']) ? route('blogs.update', $data['id']) : route('blogs.store')}}"
    enctype="multipart/form-data" class="test-form-submit-page" method="post">
    @csrf
    @if(isset($data['id']))
    <input type="hidden" name="_method" value="PUT">
    @endif
</form> -->




@endsection
@push('js')


<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

<!-- Plugin -->
<link rel="stylesheet" href="https://rawgit.com/enyo/dropzone/master/dist/dropzone.css" />
<script src="https://rawgit.com/enyo/dropzone/master/dist/dropzone.js"></script>
<script>
    $(document).on('click', '.add-module-section', function(e){
        e.preventDefault();
       let target = $(this).attr('data-target');
       $(this).parents().eq(0).find('.add-new-section').append('<div class="col-12 row-item" >'+$(this).siblings().find('.row-item').html()+'</div>');
       $(this).parents().eq(0).find('#'+target+"_row_count").val($(this).siblings().find('.row-item').length);
        let key = $(this).attr('data-key');
       $( $(this).parents().eq(0).find('.row-item')).each(function( index, value ) {
               
          let _this1 = $(this);
            $( $(this).find('.form-control')).each(function( index1, value1 ) {
              if(($(this).attr('data-lable')).indexOf('[]')) {
                let label = $(this).attr('data-lable').replace('[]');
                console.log(label, 'label')
                $(this).attr('name', label+"_"+key+"[]");

              }
              else {
                $(this).attr('name', $(this).attr('data-lable')+"_"+key);
              }
            });
        });

    })
    </script>

<script>

    $(document).on('change', '#file_upload', function(e) {
        let formToWorkOn = document.querySelector('.test-form-submit-page');
        var formData = new FormData(formToWorkOn);
        var files = $(this)[0].files;
        formData.append('file_upload', files);
        console.log(formData)

        // var data = new FormData($(this)[0]);
        var action = "{{route('upload-images')}}";
        var method = 'post';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: action,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            type: method, // For jQuery < 1.9
            success: function(response) {
                // window.location.reload();
                console.log(response, 'response')
            },
            error: function(error) {
                console.log(error, 'error')

                // $.each(error.responseJSON.errors, function(index, value) {
                //     console.log(value)
                //     $('#' + index).parents().eq(1).append(
                //         `<span class="text-danger form-error-list">${value}</span>`)
                // })
            }
        });

        // $('.form-submit-page').submit();
        
        

    })

       $(document).on('submit', '.form-submit-page', function(e) {
        e.preventDefault();
        $('.form-error-list').remove();
        var data = new FormData($(this)[0]);
        var action = "{{route('upload-images')}}";
        var method = $(this).attr('method');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: action,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: method, // For jQuery < 1.9
            success: function(response) {
                // window.location.reload();
                console.log(response, 'response')
            },
            error: function(error) {
                console.log(error, 'error')

                // $.each(error.responseJSON.errors, function(index, value) {
                //     console.log(value)
                //     $('#' + index).parents().eq(1).append(
                //         `<span class="text-danger form-error-list">${value}</span>`)
                // })
            }
        });
    })

    </script>
<script>

    $(document).on('click', '.add-section', function(e){
        e.preventDefault();
        let value = $(this).attr('data-key');
        $.ajax({
            type : "get",
            dataType : 'json',
            url : "{{route('get-sections')}}",
            data : {section_id : value},
            success : function(response) {
                console.log(response, 'response')
                $('.select-list-dev').append(response.html);
                // alert($('.'+value+"-section").length)
                $( '.'+value+"-section" ).each(function( index, value ) {
                  $(this).attr('data-key', index);
                  $(this).find('.add-new-section').attr('data-key', index);
                  $(this).find('.add-module-section').attr('data-key', index);

                  
                  let _this1 = $(this);
                    $( $(this).find('.form-control')).each(function( index1, value1 ) {
                      console.log($(this).attr('class'))
                      if(($(this).attr('data-lable')).indexOf('[]')) {
                        let label = (($(this).attr('data-lable'))).replace('[]');
                        $(this).attr('name', label+"_"+index+"[]");

                      }
                      else {
                        $(this).attr('name', $(this).attr('data-lable')+"_"+index);
                      }
                    });
                });

            },
            error : function(error) {
                console.log(error, 'error')
            }
        });
    });
   
   $(document).ready(function(){
        // $('.accordion-list > li > .answer').hide();
            
        // $(document).on('click', '.accordion-list > li', function() {
        //     if ($(this).hasClass("active")) {
        //         $(this).removeClass("active").find(".answer").slideUp();
        //     } else {
        //         $(".accordion-list > li.active .answer").slideUp();
        //         $(".accordion-list > li.active").removeClass("active");
        //         $(this).addClass("active").find(".answer").slideDown();
        //     }
        //     return false;
        // });
    });
    </script>
    <script>
        $(document).ready(function() {
  /*multiple image preview first input*/

  $(document).on("change", "#files", function(e){
    e.preventDefault();
    
  var files = e.target.files;
  var filesArr = Array.prototype.slice.call(files);
  var device = $(e.target).data("device");
  filesArr.forEach(function(f) {

    if (!f.type.match("image.*")) {
      return;
    }
    storedFiles.push(f);

    var reader = new FileReader();
    reader.onload = function(e) {
      var html = `<div>
      <img width='100' src="${e.target.result + "\" data-file='" + f.name }" class='selFile' title='Click to remove'>
      <input class="form-control" name="image_alt[]">
      <br clear="left"/>
      </div>`;

      if (device == "mobile") {
        $("#selectedFilesM").append(html);
      } else {
        $("#selectedFilesD").append(html);
      }
    }
    reader.readAsDataURL(f);
  });
  });

  selDiv = $("#selectedFilesD");
  $("#myForm").on("submit", handleForm);

  $("body").on("click", ".selFile", removeFile);

  /*end image preview */

  /* Multiple image preview second input*/
  $("#mobile").on("change", handleFileSelect);

  selDivM = $("#selectFilesM");
  $("#myForm").on("submit", handleForm);

  $("body").on("click", ".selFile", removeFile);

  console.log($("#selectFilesM").length);
});
/*multiple image preview*/


var selDiv = "";
// var selDivM="";
var storedFiles = [];

function handleFileSelect(e) {

  var files = e.target.files;
  var filesArr = Array.prototype.slice.call(files);
  var device = $(e.target).data("device");
  filesArr.forEach(function(f) {

    if (!f.type.match("image.*")) {
      return;
    }
    storedFiles.push(f);

    var reader = new FileReader();
    reader.onload = function(e) {
      var html = "<div><img src=\"" + e.target.result + "\" data-file='" + f.name + "' class='selFile' title='Click to remove'>" + f.name + "<br clear=\"left\"/></div>";

      if (device == "mobile") {
        $("#selectedFilesM").append(html);
      } else {
        $("#selectedFilesD").append(html);
      }
    }
    reader.readAsDataURL(f);
  });

}

function handleForm(e) {
  e.preventDefault();
  var data = new FormData();

  for (var i = 0, len = storedFiles.length; i < len; i++) {
    data.append('files', storedFiles[i]);
  }

  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'handler.cfm', true);

  xhr.onload = function(e) {
    if (this.status == 200) {
      console.log(e.currentTarget.responseText);
      alert(e.currentTarget.responseText + ' items uploaded.');
    }
  }

  xhr.send(data);
}

function removeFile(e) {
  var file = $(this).data("file");
  for (var i = 0; i < storedFiles.length; i++) {
    if (storedFiles[i].name === file) {
      storedFiles.splice(i, 1);
      break;
    }
  }
  $(this).parent().remove();
}



        </script>
@endpush