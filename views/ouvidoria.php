<?php 
// Retoma sessão e inclui arquivos (verificação se está logado e header)
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
    // Quando o documento for totalmente carregado
$(document).ready(()=>{

         // add class active ao item do menu principal
         $('#link-ouvidoria').addClass('active');

         // Quando clicar em enviar uma nova ouvidoria
            $('#send-attachments').click(()=>{

                // válida os campos para ná serem em brancos
                if(validField('description','descrição do caso') == false || validField('service_type','tipo de serviço afetado') == false || validField('files','anexos') == false)
                {
                    return false;
                }

                // Pega o form
                var form = $('#form')[0];

                // Cria um objeto do tipo FormData
                var formData = new FormData(form);  
                

            
          // Requisição para salvar a nova ouvidoria aberta
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

                        // Se der tudo certo retorna o modal de sucesso
                        showModalMesage('success','Mensagem!', 'Enviado com sucesso!','','');

                        // limpas os campos
                        $('#files').val('');
                        $('#service_type').val('');
                        $('#description').val('');

                        // remove as classse (para remover o "is-valid" e "is-invalid")
                        $('#description').removeClass();
                        $('#files').removeClass();
                        $('#service_type').removeClass();

                        //add as classes do form control
                        $('#description').addClass('form-control');
                        $('#files').addClass('form-control');
                        $('#service_type').addClass('form-control');

                        // manda o focu para o primeiro campo
                        $('#description').focus();
                    },
                    complete:function(){
                

                    },
                    error: function(response) {
                        
                        // Abre o modal com a mensagem de erro passada pelo back-end
                        // foca no campo files
                        showModalMesage('error',response.responseJSON.title,response.responseJSON.message,'','files');
                        
                    }
                });

                
            
            })
           

})



   

</script>

<!-- INCLUI O FIM DO HTML -->
<?php require_once __DIR__ ."/layout/layoutEnd.php" ?>