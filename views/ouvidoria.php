<?php 
// Retoma sessão e inclui arquivos (verificação se está logado e header)
session_start();

require_once __DIR__ ."/../Web/isLogged.php";
require_once __DIR__ ."/layout/layoutStart.php";
?>
<div class="container">
    <div class="row justify-content-center mt-5 mb-5 ">
        <div class="col-12 col-lg-7 col-7 d-inline-flex gap-1 mb-4"> 
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

     $('#files').change(function(e){

      
                

     })
             


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

        
                // Variável - se algum arquivo ultrapassar 2mb ele fica
                // true daí retorno o erro
                tamanhoMaximoEx = false
                // pegar a posição do arquivo que ultrapassar o limite (2Mb)
                posTamMaxExc = 0

                // Variável - se algum arquivo ter extensão não permitida ele fica
                // true
                extensaoInvalida = false
                // pegar a posição do arquivo que ter extensão não permitida
                pnameExtensaoInvalida = 0
              
                const extensoesPermitidas = ['xlsx','xls','csv','txt','pdf','rar','zip','jpg','jpeg','png']

                $.each($('#files')[0].files, function(index,item){

                    fileSize = item.size / 1024 /1024;

                    if (fileSize > 2) {
                        tamanhoMaximoEx = true
                        posTamMaxExc = index+1
                    }
                    arrayName =  item.name.split('.')
                    extensao = arrayName[arrayName.length-1]
                    if( $.inArray(extensao, extensoesPermitidas) == -1 )
                    {
                        extensaoInvalida = true
                        pnameExtensaoInvalida = item.name
                    }
                    
                    

                })
            
                // se algum arquivo ultrapassar 2Mb ele retorna a mesagem de erro junto com a posição do arquivo
                if(tamanhoMaximoEx)
                {
                    showModalMesage('error','Envio Negado','Arquivo '+posTamMaxExc+' muito grande! Tamaho máximo permitido 2Mb.','','files');
                    return 
                }

                // retorna erro se algum arquivo tiver extensão não permitida
                if(extensaoInvalida)
                {
                    showModalMesage('error','Envio Negado','Extensão do arquivo '+pnameExtensaoInvalida+' não permitida. Permitidas: xlsx, xls, csv, txt, pdf, rar, zip, jpg, jpeg, png.','','files');
                    return 
                }


                // retorna erro se a quantidade de arquivos ultrapassar 9
                if($('#files')[0].files.length > 9)
                {
                    showModalMesage('error','Envio Negado','Número máximo de arquivos permitidos por chamado 9 (nove).','','files');
                    return 
                }

            
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

                        $('#send-attachments').prop('disabled',true)
                        $('#send-attachments').html('<span style="margin-right:5px" class="spinner-border spinner-border-sm" aria-hidden="true">')
                
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
                        // Desabilita botão e remove spinner 
                        $('#send-attachments').prop('disabled',false)
                        $('#send-attachments').html('Enviar')

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