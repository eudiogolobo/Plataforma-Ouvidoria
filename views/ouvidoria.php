<?php require_once __DIR__ ."/layout/layoutStart.php";?>
<div class="container">
    <div class="row p-3">
        <div class="col-12 col-lg-6 col-6">
            <label for="" class="form-label">Descrição do Caso</label>
            <textarea name="description" class="form-control" id="description"></textarea>
        </div>

        <div class="col-12 col-lg-6 col-6">
            <label for="" class="form-label">Tipo de Serviço Afetado</label>
            <input type="text" id="service_type" name="service_type" class="form-control">
        </div>

        <div class="col-12 col-lg-6 col-md-6">
            <label for="" class="form-label">Anexos</label>
            <input class="form-control" id="files" type="file" multiple>
        </div>

        <button id="send-attachments" class="btn btn-success mt-4" >Enviar</button>
        <script>


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
            $(document).ready(()=>{

                $('#send-attachments').click(()=>{

        /*-------------------------------- INICIO FUNÇÃO PARA TRANSFORMAR ARQ EM BASE64 -----------------------------------------*/
                    // crio array q vai receber o valor em base64 dos arquivos
                    let files64 = {}
              
                    // passo o array de arquivos do input files para variavel
                    files = $('#files')[0].files

                   // faço um foreach para percorres tds os itens do array de arquivos
                    $.each(files, function(index, value){

                        // instancio a classe FileRender para usar a função readAsDataURL 
                        var reader = new FileReader()
                        // le o conteudo do tipo file
                        reader.readAsDataURL($('#files')[0].files[index])

                        // quando termina ele me retorna a url codificada em base64
                        reader.onload = function(){

                        // pego o valor em base64
                        files64[index] = reader.result

                        }

                    })

                     console.log(files64)
   /*-------------------------------- FIM BASE64 -----------------------------------------*/
                    

                    
                    $.ajax({
                        url: "../web/createOmbudsman.php",
                        type: 'POST',
                        contentType: false,
                        processData: false,
                        data: {
                            'description' : $('#description').val(),
                            'service_type' : $('#service_type').val(),
                            'files' : JSON.stringify(files64),
                        },
                        beforeSend:function()
                        {
                            $('#send-attachments').html('<span style="margin-right:5px" class="spinner-border spinner-border-sm" aria-hidden="true"><span>Enviando...</span>')
                            $('#send-attachments').attr('disabled', true);
                        },
                        success:function()
                        {

                        },
                        complete:function()
                        {
                            $('#send-attachments').html('Enviar')
                            $('#send-attachments').attr('disabled', false);
                        },
                        error:function()
                        {

                        },

                    })
                })

            })
        </script>

    </div>
    <div id="content-img"></div>
</div>
<?php require_once __DIR__ ."/layout/layoutEnd.php" ?>