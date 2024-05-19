<?php 
session_start();
require_once __DIR__ ."/../Web/isLogged.php";
require_once __DIR__ ."/layout/layoutStart.php";
?>
<div class="container">
    <div class="row justify-content-center mt-5 ">
        <div class="col-12 col-lg-7 col-7 d-inline-flex gap-1 mb-5"> 
            <h1>Abertuda de ouvidoria</h1>
        </div>
        <form class="row justify-content-center" id="form" enctype="multipart/form-data">
            <div class="col-12 col-lg-7 col-7">
                <label for="" class="form-label">Descrição do Caso</label>
                <textarea name="description" class="form-control" id="description" maxlength="500" style="height: 190px; resize: none;"></textarea>
                <div id="validation-description"></div>
            </div>

            <div class="col-12 col-lg-7 col-7 mt-4">
                <label for="" class="form-label">Tipo de Serviço Afetado</label>
                <input type="text" id="service_type" name="service_type" class="form-control" maxlength="50">
                <div id="validation-service_type"></div>
            </div>

            <div class="col-12 col-lg-7 col-7 mt-4">
                <label for="" class="form-label">Anexos</label>
                <input class="form-control" name="files[]" id="files" type="file" multiple>
                <div id="validation-files"></div>
            </div>
        </form>
        <div class="col-12 col-lg-7 col-7">
      
            <button style="width: 100%;" id="send-attachments" class="btn btn-success mt-5" >Enviar</button>
        </div>
    </div>

        
    <div id="content-img"></div>
</div>


<script>
$(document).ready(()=>{

$('#send-attachments').click(()=>{

    if(validField('description','descrição do caso') == false || validField('service_type','tipo de serviço afetado') == false || validField('files','anexos') == false)
    {
        return false;
    }
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
        success: function(response) {
            showModalMesage('success','Mensagem!', 'Enviado com sucesso!','','');
            $('#files').val('');
            $('#service_type').val('');
            $('#description').val('');

            $('#description').removeClass();
            $('#files').removeClass();
            $('#service_type').removeClass();

            $('#description').addClass('form-control');
            $('#files').addClass('form-control');
            $('#service_type').addClass('form-control');



            $('#description').focus();
        },
        complete:function(){
      

        },
        error: function(response) {
            
            showModalMesage('error',response.responseJSON.title,response.responseJSON.message,'','files');
            
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