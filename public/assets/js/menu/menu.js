(function ($) {
	"use strict";
    // menu item
    var arrayjson = $('#arrayjson').val();
    // sortable list options
    var sortableListOptions = {
    	placeholderCss: {'background-color': "#cccccc"}
    };

    var editor = new MenuEditor('myEditor', {listOptions: sortableListOptions});
    editor.setForm($('#frmEdit'));
    editor.setUpdateButton($('#btnUpdate'));
     console.log(editor);
    
    $('#btnReload').on('click', function () {
    	editor.setData(arrayjson);
    });

    $('#btnOutput').on('click', function () {
    	var str = editor.getString();
    	$("#data").val(str);
    });

    $("#btnUpdate").on('click',function(){
    	if ($('#text').val() != '' && $('#href').val() != '') {
    		editor.update();
    	}	
    });

    $('#btnAdd').on('click',function(){

    	if ($('#text').val() != '' && $('#href').val() != '') {
         
    		editor.add();
         
    	}
    	
    });

    $('#form-button').on('click',function(){
       // console.log(editor.setData(arrayjson));
    	$("#data").val(editor.getString());
    });
    console.log(arrayjson);
   
    arrayjson = JSON.parse(arrayjson);
          console.log(Object.keys(arrayjson));
    editor.setData(arrayjson);
   
})(jQuery);	

function showDiv(select){
    if(select.value== 'image'){
     document.getElementById('hidden_div').style.display = "block";
    } else{
     document.getElementById('hidden_div').style.display = "none";
    }
 } 

 function readFile() {
  
    if (!this.files || !this.files[0]) return;
      
    const FR = new FileReader();
      
    FR.addEventListener("load", function(evt) {
       // alert(myArray);
      document.querySelector("#img").src = evt.target.result;
      const myArray = evt.target.result.split(";", 2);
      var data = myArray;
      var data2 = data[0].split("/", 2);
      var data3 = data[1].split(",", 2);

      console.log(data2[1]);
     
      //document.getElementById("demo").innerHTML = myArray;
    }); 
      
    FR.readAsDataURL(this.files[0]);
  }
  
  document.querySelector("#image_upload").addEventListener("change", readFile);

 