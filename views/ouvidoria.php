<?php 
session_start();
require_once __DIR__ ."/../Web/isLogged.php";
require_once __DIR__ ."/layout/layoutStart.php";
?>
<div class="container">
  
    <div class="row p-3 justify-content-center mt-5 ">
        <form class="row justify-content-center" id="form" enctype="multipart/form-data">
            <div class="col-12 col-lg-7 col-7">
                <label for="" class="form-label">Descrição do Caso</label>
                <textarea name="description" class="form-control" id="description"></textarea>
            </div>

            <div class="col-12 col-lg-7 col-7">
                <label for="" class="form-label">Tipo de Serviço Afetado</label>
                <input type="text" id="service_type" name="service_type" class="form-control">
            </div>

            <div class="col-12 col-lg-7 col-md-7">
                <label for="" class="form-label">Anexos</label>
                <input class="form-control" name="files[]" id="files" type="file" multiple>
            </div>
        </form>
        <div class="col-12 col-lg-7 col-md-7">
      
            <button style="width: 100%;" id="send-attachments" class="btn btn-success mt-5" >Enviar</button>
        </div>
    </div>

        
    <div id="content-img"></div>
</div>


<script>
               $(document).ready(()=>{

$('#send-attachments').click(()=>{

    var form = $('#form')[0]; // You need to use standard javascript object here
    var formData = new FormData(form);  
    

 
/*-------------------------------- FIM BASE64 -----------------------------------------*/
$.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: "../web/createOmbudsman.php",
        data:formData,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 600000,
        beforeSend:function(){
     
        },
        success: function() {
         
        },
        complete:function(){
      

        },
        error: function(response) {
            
            showModalMesage('error',response.responseJSON.title,response.responseJSON.message);
            
        }
    });

    
  
})

})


        // add class active ao item do menu principal

        $('#link-ouvidoria').addClass('active');

            function base64img(obj)
            {
                let files64 = ['files']
              
                 files = $(obj)[0].files

                 console.log(files)
                 $.each(files, function(index, value){
                    var reader = new FileReader()
                    console.log(index)
                    reader.readAsDataURL($(obj)[0].files[index])
                    reader.onload = function(){

                    files64[index] = reader.result

                    }

                })

            

               
                console.log(files64)

                //obj.files.forEach(element => {
                    
                //    var reader = new FileReader()

                //    reader.readAsDataURL(obj.files[0])
                //    reader.onload = function(){
                //    alert(reader.result)
                 //   $('#content-img').append('<img src="' + reader.result + '" alt="">');
                //}

                //});
               
                
                //let clean = atob(b64)
                //alert(clean)
            }
         
        </script>


<?php require_once __DIR__ ."/layout/layoutEnd.php" ?>