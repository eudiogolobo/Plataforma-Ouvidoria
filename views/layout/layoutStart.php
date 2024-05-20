<?php 
$user = ['auth'=>false,'userName'=>'',];
//echo var_dump(session_id());
//echo var_dump($_SESSION);
 $auth = false;
  if(isset($_SESSION['password']) && isset($_SESSION['email']))
  {
    $user['auth'] = true;
    $user['userName'] = $_SESSION['userName'];
  
  }
?>
<!-- COMEÇO DO LAYOUT PADRÃO -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CDNs bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- CDN jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- CDN mask -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="../public/Js/JsStart.js" defer></script>
    <link rel="stylesheet" href="../public/css/layout.css">
    <link rel="stylesheet" href="../public/css/animationSuccess.css">
    <title></title>
</head>
<body>

<!-- carregar as cidades assim que o DOM esteja pronto -->
  <script>
function ReenviarCodigoVerificacao(inputId)
{
  if($('#'+inputId).hasClass('reenviarCodigoVerificacao')){

    $.ajax({
            type: "POST",
            url: "../web/reenviarCodigoVerificacao.php",
            data: {'email' : $('#email').val(), 'name': $('#name').val()},
            success: function() {

              console.log('e-mail reenviado...')
            },
           
            error: function(response) {
              console.log('erro ao reenviar e-mail...')
            }
          });
    
  
  } 
  
}
   





    $(document).ready(()=>{


  // Muda a classe do Dropdwon do menu superior direito de acordo com o tamanho do browser
    // Porque no celular/ tablet o dropdown tava ficando no fim 
    // e só queria deixar no fim em computador...
    if($(window).width() < 991)
      {
     
        $('#dropdown-menu-header').removeClass('dropdown-menu-end')
        $('#dropdown-menu-header').addClass('dropdown-menu-start')

      }else{
        $('#dropdown-menu-header').addClass('dropdown-menu-end')
        $('#dropdown-menu-header').removeClass('dropdown-menu-start')

      }

    // Se redimenssionar o tamanho do browser ele 
    // Muda a classe do Dropdwon do menu superior direito
    // Porque no celular/ tablet o dropdown tava ficando no fim 
    // e só queria deixar no fim em computador...
    $(window).resize(()=>{
      if($(window).width() < 991)
      {
     
        $('#dropdown-menu-header').removeClass('dropdown-menu-end')
        $('#dropdown-menu-header').addClass('dropdown-menu-start')

      }else{
        $('#dropdown-menu-header').addClass('dropdown-menu-end')
        $('#dropdown-menu-header').removeClass('dropdown-menu-start')

      }
    })


         //pego o arquivo json com as cidades e UF
        $.getJSON("../public/json/cities_states.json", (data) => {

        // crio um array
        let items = [];

        //crio a variavel com que vai ter as opt
        let options = '<option></option>';

        //loop para carregar opt de UF
        for (val of data) {
            options += '<option value="' + val.sigla + '">' + val.sigla + '</option>';
        }


            // coloco o html da variavel opt no elemento com ID fu (UF)
            $("#fu").html(options);				


            // toda vez que o valor do elemento Fu alterar recarrego o SELECT das cities
            $("#fu").change( () => {				
                // varivel para receber o HTML das cidades
                let options_cities = '<option></option>';

                // pego o valor do select FU
                let str = $("#fu").val();					
                
                // crio um loop, carrgando minha variavel options_cities com as cidades da FU que está selecionada
                for (val of data) {

                    // se a sigla do loop for igual á sigla da variavel "str" (valor do select FU) ele add todas as cidades desse item
                    if(val.sigla == str) {							
                        for (val_city of val.cidades) {
                        options_cities += '<option value="' + val_city + '">' + val_city + '</option>';
                        }							
                    }
                }
                // carrego o select das cidades
                $("#city").html(options_cities);        
            });		

        });

      

        // add maskara ao input telefone
       $('#telephone').mask("(99) 9999-9999")
        .focusout(function (event) {  
            var target, phone, element;  
            // obtem o elemento q acionou a funcao se for uma versao mais antiga do navegador pega atraves do srcElement
            target = (event.currentTarget) ? event.currentTarget : event.srcElement; 
            //expressao regular que remove se nao for numero
            phone = target.value.replace(/\D/g, '');
            // elemento recebe o novo valor so com numero 
            element = $(target);   
        });

        // add maskara ao input whatsapp
        $('#whatsapp').mask("(99) 9999-9999")
        .focusout(function (event) {  
            var target, phone, element;  
            // obtem o elemento q acionou a funcao se for uma versao mais antiga do navegador pega atraves do srcElement
            target = (event.currentTarget) ? event.currentTarget : event.srcElement; 
            //expressao regular que remove se nao for numero
            phone = target.value.replace(/\D/g, '');
            // elemento recebe o novo valor so com numero 
            element = $(target);   
        });

          // toda vez que clicar no botao ok do modal mensagens/avisos ele remove as propriedades target e o toogle do botão 
          $('#btn-ok-modal-mesage').click(function(){

            $(this).removeAttr('data-bs-target')
            $(this).removeAttr('data-bs-toggle')
          
            setTimeout(() => {
              $('#btn-ok-modal-mesage').removeAttr('onclick')
                $(this).removeClass()
                $(this).addClass('btn btn-success')
            }, 500);

            })
        // toda vez que clicar no botao ok do modal de opções ele remove as propriedades target e o toogle do botão 
            $('#btn-ok-modal-options').click(function(){

              ReenviarCodigoVerificacao('btn-ok-modal-options')

            $('#btn-cancel-modal-options').removeAttr('data-bs-target')
            $('#btn-cancel-modal-options').removeAttr('data-bs-toggle')

            $(this).removeAttr('data-bs-target')
            $(this).removeAttr('data-bs-toggle')
            $(this).removeClass()
            $(this).addClass('btn btn-success')

            })
        // toda vez que clicar no botao cancel do modal de opções ele remove as propriedades target e o toogle do botão 
            $('#btn-cancel-modal-options').click(function(){

            $('#btn-ok-modal-options').removeAttr('data-bs-target')
            $('#btn-ok-modal-options').removeAttr('data-bs-toggle')

            $(this).removeAttr('data-bs-target')
            $(this).removeAttr('data-bs-toggle')

            })

  // chama a funcao para validar e ir ao prixmo modal
  $('#btn-prox-modal-create-account').click(()=>{

    // faz a validação dos campos do formulário
    // se estiverem válidos ele fa uma requisição para
    // ver se o e-mail já existe no banco de dados
    // se não existir ele abre o próximo modal de senha
      if(validatorModalCreateAccount())
      {

          $.ajax({
            type: "POST",
            url: "../web/verificaEmail.php",
            data: {'email' : $('#email').val()},
            beforeSend:function(){
              // Desabilita botão e adiciona spinner de carregamento
              $('#btn-prox-modal-create-account').prop('disabled',true)
              $('#btn-prox-modal-create-account').html('<span style="margin-right:5px" class="spinner-border spinner-border-sm" aria-hidden="true">')
            },
            success: function() {

              // Caso não retorne erro abre o próximo modal de criação de senha
              $('#modal-create-account').modal('hide')
              $('#modal-create-password').modal('show')

            },
            complete:function(){
              // Desabilita botão e remove spinner 
              $('#btn-prox-modal-create-account').prop('disabled',false)
              $('#btn-prox-modal-create-account').html('Próximo')

            },
            error: function(response) {
              // Retorna erro de conexão com banco de dados
              if(response.responseJSON.code == 1001)
              {
                showModalMesage('error',response.responseJSON.title,response.responseJSON.message,'modal-create-account');
              }else
              // Retorna erro de e-mail já cadastrado
              if(response.responseJSON.code == 1002)
              {
                showModalMesage('error',response.responseJSON.title,response.responseJSON.message,'modal-create-account','email');
              }
              // Retorna modal de opções para reenviar código de confirmação para o e-mail
              if(response.responseJSON.code == 1003)
              {
                ShowModalOptions('reenviarCodigo',response.responseJSON.title,response.responseJSON.message,'modal-verification-code','codigo-verificacao-email', 'modal-create-account','email');
              }
              
            }
          });

       
      }
  })


 
  
  $('#btn-create-user').click(function(){


    // Faz validação dos campos em branco
    if(validField('password','senha','modal-create-password') == false || validField('password-comnfirm','confirmação de senha','modal-create-password') == false){
      return
    }


    // Verifica se senha é maior que 8 caracteres
    if( $('#password').val().length < 8)
    {
      showModalMesage('error','Senha inválida','A senha deve ter no mínimo 8 caracteres.','modal-create-password');
      $('#password').focus()
      return
    }

    // Verifica se senha e confirmação de senha são iguais
    if( $('#password').val() != $('#password-comnfirm').val())
    {
      showModalMesage('error','Senha inválida','A senha e a confirmação de senha não são iguais.','modal-create-password');
      $('#password').focus()
      return
    }

    // cria objeto com os valores dos campos 
    dataUser = {
      'name':$('#name').val(),
      'date-birth': $('#date-birth').val(),
      'email': $('#email').val(),
      'telephone': $('#telephone').val(),
      'whatsapp': $('#whatsapp').val(),
      'password': $('#password').val(),
      'password_comnfirm': $('#password-comnfirm').val(),
      'city': $('#city').val(),
      'fu': $('#fu').val(),

    }

    $.ajax({
          type: "POST",
          url: "../web/createUser.php",
          data: dataUser,
          beforeSend:function(){
           
            // Abre modal de cadastro concluído
             showModalMesage('success','Parabéns!','Seu cadastro foi realizado com sucesso!','modal-verification-code')
             // Desabilita o botão de Próximo
             $('#btn-create-user').prop('disabled',true)
             // Add spinner 
              $('#btn-create-user').html('<span style="margin-right:5px" class="spinner-border spinner-border-sm" aria-hidden="true">')
          },
          success: function() {
            // Limpa os campos
            $('#name').val('')
            $('#date-birth').val('')
            $('#email').val('')
            $('#telephone').val('')
            $('#whatsapp').val('')
            $('#password').val('')
            $('#password-comnfirm').val('')
            $('#city').val('')
            $('#fu').val('')

            // Remove as classes 
            $('#name').removeClass('is-valid')
            $('#date-birth').removeClass('is-valid')
            $('#email').removeClass('is-valid')
            $('#telephone').removeClass('is-valid')
            $('#whatsapp').removeClass('is-valid')
            $('#password').removeClass('is-valid')
            $('#password-comnfirm').removeClass('is-valid')
            $('#city').removeClass('is-valid')
            $('#fu').removeClass('is-valid')
          },
          complete:function(){
             // Abilita o Próximo, remove o spinner a add texto "Próximo"
              $('#btn-create-user').prop('disabled',false)
              $('#btn-create-user').html('Próximo')

            },
          error: function(response) {
            // Tratamento de erro
            showModalMesage('error',response.responseJSON.title,response.responseJSON.message,'modal-create-password');

          }
        });



 
  })
  
  $('#btn-login').click(()=>{

    // Faz requisição para logar
    $.ajax({
          type: "POST",
          url: "../web/login.php",
          data: {'email' : $('#email-login').val(), 'password': $('#password-login').val()},
          beforeSend:function(){
             // Abilita o botão de logar e adiciona o spinner nele
            $('#btn-login').prop('disabled',true)
            $('#btn-login').html('<span style="margin-right:5px" class="spinner-border spinner-border-sm" aria-hidden="true">')
          },
          success: function() {

           // Se e-mail, senha correto e status ativo ele loga e recarrega a página
            location.reload();

          },
          complete:function(){
            // Abilita o botão de logar e remove o spinner e add texto de "Enviar no botão"
            $('#btn-login').prop('disabled',false)
            $('#btn-login').html('Enviar')

          },
          error: function(response) {
            // Retorna o erro de senha ou e-mail inválidos
            showModalMesage('error',response.responseJSON.title,response.responseJSON.message,'modal-login','email-login');
          }
        });

  })


 

  // Validar código de verificação
  $('#btn-codigo-verificacao-email').click(()=>{

    // Se o códiog do campo estiver vazio retorna modal de erro
    if(validField('codigo-verificacao-email', 'código','modal-verification-code') == false)
    {
      return ;
    }

    // Faz requisição GET para validar enviando o código digitado pelo usuário
    $.ajax({
          type: "GET",
          url: "../web/ValidarCodigoEmail.php",
          data: {'code' : $('#codigo-verificacao-email').val()},
          beforeSend:function(){
            $('#btn-codigo-verificacao-email').prop('disabled',true)
            $('#btn-codigo-verificacao-email').html('<span style="margin-right:5px" class="spinner-border spinner-border-sm" aria-hidden="true">')
          },
          success: function() {

            // Recarrega a página caso o código esteja correto
            showModalMesage('success','Conta Verificada!','Parabéns, seu cadastro foi concluído com sucesso!','','','http://localhost/plataforma-ouvidoria/views/');

          },
          complete:function(){

            // Remove o spinner do btão e add o html nele de "Enviar"
            $('#btn-codigo-verificacao-email').prop('disabled',false)
            $('#btn-codigo-verificacao-email').html('Enviar')

          },
          error: function(response) {
            // Retorna modal de erro no código de verificação
            showModalMesage('error',response.responseJSON.title,response.responseJSON.message,'modal-verification-code','codigo-verificacao-email');
          }
        });
    })

    $('#btn-logout').click(()=>{

    // requisição para sair  
      $.ajax({
        type: "GET",
        url: "../web/logout.php",
        beforeSend:function(){
          $('#btn-logout').prop('disabled',true)
        },
        success: function() {
          location.reload();
        },
        complete:function(){
          $('#btn-logout').prop('disabled',false)

        },
        error: function(response) {
         
            showModalMesage('error','ERROR',"Erro ao Sair. Tente novamente!");
          
          
        }
      });

   
  
})

       
    })

   

</script>
<!-- COMEÇO Modal de mensagens/ avisos-->
<div class="modal fade modal-sm"  id="modal-mesage" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 id="modal-mesage-title" class="modal-title fs-5"></h1>
      </div>
      
      <div id="body-modal-mesage" class="modal-body" style="display: flex; align-items: center;  flex-direction: row;"></div>
      
      <div class="modal-footer g-3">
        <div id="group-buttons-modal-mesage" class="d-grid gap-2 d-md-flex justify-content-md-centered" style="width:100%">
            <button id="btn-ok-modal-mesage" style="width: 100%;" type="button" data-bs-dismiss="modal">Ok</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- FIM Modal de mensagens/ avisos-->

<!-- COMEÇO Modal de OPÇÕES/ YES/NO-->
<div class="modal fade modal-sm"  id="modal-options" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 id="modal-options-title" class="modal-title fs-5"></h1>
      </div>
      
      <div id="body-modal-options" class="modal-body" style="display: flex; align-items: center;  flex-direction: row;"></div>
      
      <div class="modal-footer" class="row my-5 justify-content-center">
      
            <div class="d-inline-flex gap-1 col-12 col-sm-12 mt-4" style="width: 100%;">
              <button style="width: 50%;" id="btn-ok-modal-options" class="btn btn-success" type="button">Yes</button>
              <button id="btn-cancel-modal-options" style="width: 50%;" type="button" class="btn btn-secondary" >No</button>
            </div>
        
      </div>
    </div>
  </div>
</div>
<!-- FIM Modal de OPÇÕES/ YES/NO-->

<!-- COMEÇO NAVBAR -->
<nav class="navbar navbar-expand-lg bg-primary border-body sticky-top" data-bs-theme="dark">
  <div class="container-fluid">
  <a class="navbar-brand" href="./home.php"><img height="30px" src="../public/img/logo-prefa.png"  alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item ">
          <a id="link-main" class="nav-link" aria-current="page" href="./home.php">Principal</a>
        </li>

       
        <?php 
        // Se usuário estiver logado adiciona o dropdown de ouvidoria
        if($user['auth'] == true)
        {
          echo '<li class="nav-item dropdown">';
          echo   '<button id="link-ouvidoria" class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Ouvidoria</button>';
          echo    '<ul class="dropdown-menu">';
          echo      '<li><a  class="dropdown-item" href="./ouvidoria.php">Nova</a></li>';
          echo      '<li><a  class="dropdown-item" href="./ouvidoriaListar.php">Ver Minhas</a></li>';
          echo     '</ul>';
          echo '</li>';
        } 
        ?>
       
         
      
      </ul>

      <!-- Se o usuário não  estiver logado add o botão de login e cadastrar-se, se sim ele adiciona o html do Dropdpwn de usuários -->
      <?php if($user['auth'] == false){
               echo '<button class="btn btn-light me-2" data-bs-target="#modal-login" data-bs-toggle="modal">Entrar</button>';
                echo '<button class="btn btn-outline-light" data-bs-target="#modal-create-account" data-bs-toggle="modal">Cadastrar-se</button>';
            } else{

              echo '<div class="nav-item dropdown" style="width: auto;">';
              echo '<button type="button" style="min-width: 100px;margin: 0;padding: 0; background-color: transparent;border: none;display: flex; align-items: center;vertical-align:middle ;" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" data-bs-display="static" data-bs-auto-close="outside">';
              echo '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person-fill me-2" viewBox="0 0 16 16">';
              echo '<path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>';          
              echo ' </svg>';      
              echo $user['userName'];       
                     
              echo '</button>';
              echo '<div id="dropdown-menu-header" class="dropdown-menu dropdown-menu-end p-1" style="max-width: 100px;">';
                
              echo '<button id="btn-modal-my-perfil" style="text-align: left; width: 100%;" class="btn btn-dark" data-bs-target="#modal-my-user" data-bs-toggle="modal">Meu perfil</button>';
              echo  '<button id="btn-logout" style="text-align: left; width: 100%;" class="btn btn-dark">Sair</button>';
                
                
              echo '</div>';
        
       
              echo'</div>';
              
            }
        ?>
    
  </div>
</nav>
<!-- FIM NAV BAR -->

<!-- COMEÇO MODAL DE CADASTRO -->
<div class="modal fade modal-lg" id="modal-create-account" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="content p-4 row g-3 m-3">
            <div class="col-10 col-sm-11 col-md-11">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Informações Pessoais</h1> 
            </div>
            <div class="col-2 col-sm-1 col-md-1" style="display: flex; align-items: center;">
                <button type="button" style="margin-left: auto;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <hr>
            
            <div class="col-sm-12 col-lg-6">
                <label for="name" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome completo">
                <div id="validation-name"></div>
            </div>
            <div class="col-sm-5 col-lg-3">
                <label for="date_birth" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="date-birth" name="date_birth" value="2005-01-10">
                <div id="validation-date-birth"></div>
            </div>
            <div class="col-sm-7 col-lg-3">
                <label for="telephone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telefone">
                <div id="validation-telephone"></div>
            </div>
            <div class="col-sm-5 col-lg-3">
                <label for="whatsapp" class="form-label">WhatsApp</label>
                <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp">
                <div id="validation-whatsapp"></div>
            </div>
            <div class="col-sm-7 col-lg-7">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" id="email" placeholder="E-mail">
                <div id="validation-email"></div>
            </div>
            <div class="col-sm-4 col-lg-2">
                <label for="fu" class="form-label">UF</label>
                <select name="fu" id="fu" class="form-select"></select>
                <div id="validation-fu"></div>
            </div>
            <div class="col-sm-8 col-lg-5">
                <label for="city" class="form-label">Cidade</label>
                <select name="city" id="city" class="form-select"></select>
                <div id="validation-city"></div>
            </div>
            <div style="display:flex;justify-content: end;" class="gap-2">
                <button style="width: 100px;" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button style="width: 100px;"  id="btn-prox-modal-create-account" type="button" class="btn btn-primary">Próximo</button>
            </div>
            
        </div>
      </div>
    </div>
  </div>
</div>
<!-- FIM MODAL DE CADASTRO -->

<!-- COMEÇO DE CRIAÇÃO DE SENHA -->
<div class="modal fade modal-pq" id="modal-create-password" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     
      <div class="modal-create-password-body">
      
            <div class="row my-5 justify-content-center"> 
                <div class="col-8 col-sm-8 col-md-8">
                    <h1 class="modal-title fs-5">Nova Senha</h1> 
                </div>
                <div class="col-2 col-sm-1 col-md-1" style="display: flex; align-items: center;">
                    <button type="button" style="margin-left: auto;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="col-10 col-sm-9 col-md-9">
                  <hr>
                </div>
                <div class="col-10 col-sm-9 col-md-9 mt-4">
                    <label for="password" class="form-label">Senha</label>
                    <input type="text" class="form-control" id="password" name="password" placeholder="Nova senha">
                    <div id="validation-password"></div>
                </div>
            
            
                  <div class="col-10 col-sm-9 col-md-9 mt-4 mb-5">
                      <label for="password_comnfirm" class="form-label">Confirme sua senha</label>
                      <input type="text" class="form-control" id="password-comnfirm" name="password-comnfirm" placeholder="Confirme a senha">
                      <div id="validation-password-comnfirm"></div>
                  </div>
                  <div class="d-inline-flex gap-1 col-10 col-sm-9 col-md-9 mt-4">
                    <button style="width: 50%;" type="button" data-bs-target="#modal-create-account" data-bs-toggle="modal" class="btn btn-secondary">Voltar</button>
                    <button style="width: 50%;" id="btn-create-user" type="button" class="btn btn-primary">Próximo</button>
                  </div>
              
            </div>
           
      </div>
    
    </div>
  </div>
</div>
<!-- FIM MODAL DE CRIAÇÃO DE SENHA -->

<!-- COMEÇO MODAL DE CODIGO DE VERIFICACAO -->
<div class="modal fade modal-pq" id="modal-verification-code" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-verification-code-body">
          <div class="row my-5 justify-content-center ">
             
              <div class="col-8 col-sm-8 col-md-8">
                    <h1 id="modal-login-title" class="modal-title fs-5">Código de Verificação</h1>
                </div>
                <div class="col-2 col-sm-1 col-md-1" style="display: flex; align-items: center;">
                    <button type="button" style="margin-left: auto;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="col-10 col-sm-9 col-md-9">
                  <hr>
                </div>

                <div class="col-10 col-sm-9 col-md-9 mt-3">
                    <p style="font-size: medium;" class="mb-5">Enviamos um código de verificação para o seu endereço de e-mail.</p>
                    <label for="codigo-verificacao-email" class="form-label">Código</label>
                    <input type="text" class="form-control" id="codigo-verificacao-email" name="codigo-verificacao-email" placeholder="Código">
                    <div id="validation-codigo-verificacao-email" class="mb-5"></div>
                </div>
                <div class="d-grid gap-2 col-10 col-sm-9 col-md-9 mx-auto mt-5">
                    <button id="btn-codigo-verificacao-email" type="button" class="btn btn-primary">Enviar</button>
                </div>
               
              </div>
      </div>
    </div>
  </div>
</div>
<!-- FIM MODAL DE CODIGO DE VERIFICACAO -->

<!-- COMEÇO Modal de LOGIN-->
<div class="modal fade" id="modal-login" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog  modal-dialog-top">
    <div class="modal-content">
      <div id="body-modal-login" class="modal-body" style="display: flex; align-items: center;  flex-direction: row;">
            <div class="row my-5 justify-content-center ">

                <div class="col-10 col-sm-8 col-md-8">
                    <h1 id="modal-login-title" class="modal-title fs-5">Entrar</h1>
                </div>
                <div class="col-2 col-sm-1 col-md-1" style="display: flex; align-items: center;">
                    <button type="button" style="margin-left: auto;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  
                </div>
                <div class="col-12 col-sm-9 col-md-9">
                  <hr>
                </div>
                
                <div class="col-12 col-sm-9 col-md-9 mt-4">
              
                    <label for="email-login" class="form-label">E-mail</label>
                    <input type="text" class="form-control"  id="email-login" placeholder="E-mail...">
                </div>
                <div class="col-12 col-sm-9 col-md-9 mt-4">
                    <label for="email-login" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password-login" placeholder="Senha...">
           
                </div>
                <div class="mt-4 col-12 col-sm-9 col-md-9">
                    <a href="#">Esqueci minha senha</a>
                </div>
                <div class="d-grid gap-2 col-12 col-sm-9 col-md-9 mx-auto mt-5">
                    <button id="btn-login" class="btn btn-success">Entrar</button>
                </div>
               
               
            </div>
      </div>
    </div>
  </div>
</div>
<!-- FIM Modal LOGIN -->

<!-- COMEÇO MODAL DE MEU PERFIL DE USUÁRIO -->
<div class="modal fade modal-pq" id="modal-my-user" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-my-user-body">
          <div class="row my-5 justify-content-center ">
             
              <div class="col-8 col-sm-8 col-md-8">
                    <h1 id="modal-login-title" class="modal-title fs-5">Meu Perfil</h1>
                </div>
                <div class="col-2 col-sm-1 col-md-1" style="display: flex; align-items: center;">
                    <button type="button" style="margin-left: auto;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="col-10 col-sm-9 col-md-9">
                  <hr>
                </div>

                <div class="col-10 col-sm-9 col-md-9 mt-3">
                    <p><strong>Nome:</strong> <?php if(isset($_SESSION['userName'])){echo $_SESSION['userName'];}?>  </p>
                    <p><strong>E-mail:</strong> <?php if(isset($_SESSION['email'])){echo $_SESSION['email'];} ?></p>
                  <div id="data-my-user" ></div>
                </div>
              </div>
      </div>
    </div>
  </div>
</div>
<!-- FIM MODAL DE MEU PERFIL DE USUÁRIO -->
    
