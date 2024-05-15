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

    <!-- CDN mask -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>


    <title><?=$title?></title>
</head>
<body>


<!-- carregar as cidades assim que o DOM esteja pronto -->
  <script>


/*------------------------------------------ FUNÇÕES  -----------------------------------------*/


        // funcao para validar email (vai ser utilizada no login e na criação de conta)
        function validEmail(inputEmail)
        {
            // modelo de como deve ser o email
            var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            // se o input for incompativel com o filtro retorna mensagem de erro
            // e remove a classe is-valid do input e da div de mensagem do input
            // e add a clase is-invalid no input e na div de mensagem do input
            if (!filter.test($('#'+inputEmail).val())) {

              showModalMesage('error', 'E-mail inválido', 'Por favor, insira um e-mail válido.','modal-create-account','email')
              $('#'+inputEmail).removeClass('is-valid')
              $('#validation-'+inputEmail).removeClass('is-valid')

              $('#'+inputEmail).addClass('is-invalid')
              $('#validation-'+inputEmail).addClass('is-invalid')
              $('#validation-'+inputEmail).html('Campo obrigatório.')
        
        
              return false
            }

            // se passar quer dizer q é válido
            // e remove a classe is-invalid do input e da div de mensagem do input
            // e add a clase is-valid no input e na div de mensagem do input
            $('#'+inputEmail).removeClass('is-invalid')
            $('#validation-'+inputEmail).removeClass('is-invalid')

            $('#validation-'+inputEmail).html('')

            $('#'+inputEmail).addClass('is-valid')
            $('#validation-'+inputEmail).addClass('is-valid')

            return
        }

    

        // funcao para moldar e chamar meu modal de mensagens
        function showModalMesage(typeModal, titleModal, htmlContent, modalTarget, nameInputFocus, redirectValue)
        {
          // seleciono todos os modais
          var modals = $('.modal').each(function(){
            // fecho todos
            $(this).modal('hide')
          })
          
          // se o parametro typeModal for success coloco a classe btn-success no botao para deixar verde e coloco uma animação em html e css de sucesso
          if(typeModal == 'success') 
          {
            $('#body-modal-mesage').html('<div class="success-checkmark"><div class="check-icon"><span class="icon-line line-tip"></span><span class="icon-line line-long"></span><div class="icon-circle"></div><div class="icon-fix"></div></div></div><span style="margin-left: 1rem;">'+htmlContent+'</span></div>')
            $('#btn-ok-modal-mesage').addClass('btn btn-success')
          } 

          // se o parametro typeModal for error add a classe btn-danger no botao para deixar vermelho 
          if(typeModal == 'error')
          {
            $('#body-modal-mesage').html(htmlContent)
            $('#btn-ok-modal-mesage').addClass('btn btn-danger')
            $('#btn-ok-modal-mesage').attr('onclick', 'elementFocus("'+nameInputFocus+'")')
           

          }

          // passo o valor do parametro titleModal para o titulo do modal
          $('#modal-mesage-title').html(titleModal)


          // se houver valor no parametro modalTarget eu add o valor dele 
          // ao data-bs-target e add data-bs-toggle para abrir o modal quando clicarem em ok
          if(modalTarget != undefined)
          {
            $('#btn-ok-modal-mesage').attr('data-bs-target', '#'+modalTarget)
            $('#btn-ok-modal-mesage').attr('data-bs-toggle',"modal")
          }

          // abro o modal-mesage
          $('#modal-mesage').modal('show')


          // se houver valor ao redirectValue eu redireciono o usuario ao clicar no btn ok do modal-mesage
          if(redirectValue != undefined)
          {
            $('#btn-ok-modal-mesage').click(()=>{
              window.location.href = redirectValue
            })
          }

        }

      /*-------------------------------------- FIM da função validEmail ----------------------------------*/


// função que vai ser atribuida no evento onclick ao btn do modal-mesage quando o typeModal for ERROR
// para focar no campo inválido 
function elementFocus(idInputFocus)
{
  setTimeout(()=>{
    $('#'+idInputFocus).focus()
  }, 500)

}

//funcao para validar os campos do formulário
function validField(idField, personalizedName)
{
  // se o valor do campo com o id que foi passado for vazio 
  // ele chama o modal do type error e adddiciona as classes is-invalid no input 
  // e na div da mensagem em baixo do input dai retorna false
  if($('#'+idField+'').val() == '')
        {
          showModalMesage('error','Campo inválido', 'Campo obrigatório '+personalizedName+' em branco','modal-create-account',idField); 
          $('#'+idField).removeClass('is-valid')
          $('#validation-'+idField).removeClass('is-valid')

          $('#'+idField).addClass('is-invalid')
          $('#validation-'+idField).addClass('is-invalid')
          $('#validation-'+idField).html('Campo obrigatório.')
          return false
        } else{

          // se o campo é diferente de vazio ele add a classe is-valid no input
          // e remove o text da div de mensagem em baixo do input, então retorna true 
          $('#'+idField).removeClass('is-invalid')
          $('#validation-'+idField).removeClass('is-invalid')

          $('#validation-'+idField).html('')

          $('#'+idField).addClass('is-valid')
          $('#validation-'+idField).addClass('is-valid')
      
            return true
        }
}


// funcao para validar o modal-account-create e ir para o próximo modal de criação de senha

function validatorModalCreateAccount()
   {

        // chama a função validFiel para ver se o campo está em branco e se retornar 
        // false retorna true saindo da função de salvar
        if(validField('name','nome') == false || validField('date-birth','data de nascimento') == false || validField('telephone','telefone') == false || validField('whatsapp','whatsapp') == false || validField('email','e-mail') == false || validEmail('email') == false || validField('city', 'cidade') == false)
        {
          return false
        }


        /*---------------------------- validação maior de idade --------------------------------------*/

            //pego o valor do input date
            dt = $('#date-birth').val();

            //transformo em array separando cada indice pela barra, inverto e junto tudo de novo devolvendo a barra
            dt = dt.split('/').reverse().join('/');

            // atribuo o valor do objeto Date numa variaval
            dob = new Date(dt);

            // pedo a data de hoje
            var today = new Date();

            // calculo a idade diminuindo a data de hoje menos a data que o usuario digitou dai
            // o retorno vem em milissegundo, em seguida divido pela quantidade de milissegundo de um ano 
            // e obtenho essa divisão do menor numero inteiro usando o Floor
            var idade = Math.floor((today-dob) / (365.29 * 24 * 60 * 60 * 1000));

            // se a idade for menos que 18 retorno o erro
            if(idade < 18)
            {
            showModalMesage('error','Menor de idade', 'Para você se cadastrar, deve ter no mínimo 18 anos.','modal-create-account','date-birth');
            return false
            }
        
         return true
    }

    $(document).ready(()=>{

         //pego o arquivo json com as cidades e UF
        $.getJSON("public/json/cities_states.json", (data) => {

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

        // add class active ao item do menu principal

        $('#link-main').addClass('active');

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

          // toda vez que clicar no botao ok do modal ele remove as propriedades target e o toogle do botão 
          $('#btn-ok-modal-mesage').click(function(){

            $(this).removeAttr('data-bs-target')
            $(this).removeAttr('data-bs-toggle')
            setTimeout(() => {
                $(this).removeClass()
                $(this).addClass('btn btn-success')
            }, 500);


            })

  // chama a funcao para validar e ir ao prixmo modal
  $('#btn-prox-modal-create-account').click(()=>{
      if(validatorModalCreateAccount())
      {
        $('#modal-create-account').modal('hide')
        $('#modal-create-password').modal('show')
      }
  })

  $('#btn-create-user').click(()=>{
    console.log('click')

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
             //url da pagina
             url: 'stores/createUser.php',
             //url: $("#baseURL").val()+'/views/romaneio/tes.php',
             //parametros a passar
             data: dataUser,
             //tipo: POST ou GET
             dataType: 'text',
             type: 'POST',
             //cache
             cache: false,
             success: function(data){
                 console.log(data)
             },
             error:function(data)
             {
              console.log('ERRO:  '+data)
             },


             })
  })

       
    })

   

</script>
<button data-bs-target="#modal-create-password" data-bs-toggle="modal">anda</button>
<button data-bs-target="#modal-list-ouvidoria" data-bs-toggle="modal">anda</button>
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

<!-- COMEÇO NAVBAR -->
<nav class="navbar navbar-expand-lg bg-primary border-body sticky-top" data-bs-theme="dark">
  <div class="container-fluid">
  <a class="navbar-brand" href="{{route('main.index')}}"><img height="30px" src="{{asset('img/LabMaker.svg')}}" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item ">
          <a id="link-main" class="nav-link" aria-current="page" href="<?= __DIR__ ."/../../"?>">Principal</a>
        </li>

        <li class="nav-item">
          <a id="link-reports" class="nav-link " href="{{route('reports.index')}}">Relatórios</a>
        </li>

      
          <li class="nav-item">
             <a id="link-users" class="nav-link " href="{{route('users.create')}}">Usuários</a>
          </li>
      
          <li class="nav-item dropdown">
          <button id="link-administration" class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Administração</button>
            <ul class="dropdown-menu">
              <li><a  class="dropdown-item" href="{{route('schedules.create')}}">Agendas</a></li>
              <li><a  class="dropdown-item" href="{{route('environments.create')}}">Ambientes</a></li>
            </ul>
          </li>

  
        <li class="nav-item ">
          <a id="link-computer" class="nav-link" aria-current="page" href="{{route('computers.view')}}">Computadores</a>
        </li>
      </ul>

      <button class="btn btn-light me-2">Entrar</button>
      <button class="btn btn-outline-light" data-bs-target="#modal-create-account" data-bs-toggle="modal">Cadastrar-se</button>
  </div>
</nav>
<!-- FIM NAV BAR -->

<!-- COMEÇO MODAL DE CADASTRO -->
<div class="modal fade modal-lg" id="modal-create-account" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastre-se 1/2</h1> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="content p-4 row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome completo">
                <div id="validation-name"></div>
            </div>
            <div class="col-md-3">
                <label for="date_birth" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="date-birth" name="date_birth" value="2005-01-10">
                <div id="validation-date-birth"></div>
            </div>
            <div class="col-md-3">
                <label for="telephone" class="form-label">Telefone</label>
                <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telefone">
                <div id="validation-telephone"></div>
            </div>
            <div class="col-md-3">
                <label for="whatsapp" class="form-label">WhatsApp</label>
                <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp">
                <div id="validation-whatsapp"></div>
            </div>
            <div class="col-md-7">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" id="email" placeholder="E-mail">
                <div id="validation-email"></div>
            </div>
            <div class="col-md-2">
                <label for="fu" class="form-label">UF</label>
                <select name="fu" id="fu" class="form-select"></select>
                <div id="validation-fu"></div>
            </div>
            <div class="col-md-5">
                <label for="city" class="form-label">Cidade</label>
                <select name="city" id="city" class="form-select"></select>
                <div id="validation-city"></div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onmouseleave="" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button id="btn-prox-modal-create-account" type="button" class="btn btn-primary">Próximo</button>
      </div>
    </div>
  </div>
</div>
<!-- FIM MODAL DE CADASTRO -->

<!-- COMEÇO DE CRIAÇÃO DE SENHA -->
<div class="modal fade modal-pq" id="modal-create-password" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Cadastre-se 2/2</h1> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-create-password-body">
          <div class="content p-4 row g-3">
              <div class="row justify-content-md-center mt-3"> 
                <div class="col-md-7">
                    <label for="password" class="form-label">Senha</label>
                    <input type="text" class="form-control" id="password" name="password" placeholder="Senha">
                    <div id="validation-password"></div>
                </div>
              </div>
              <div class="row justify-content-md-center mt-3"> 
                  <div class="col-md-7">
                      <label for="password_comnfirm" class="form-label">Confirm sua senha</label>
                      <input type="text" class="form-control" id="password-comnfirm" name="password-comnfirm" placeholder="Confirme a senha">
                      <div id="validation-password-comnfirm"></div>
                  </div>
              </div>
        
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" onmouseleave="" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button id="btn-create-user" type="button" class="btn btn-primary">Enviar</button>
      </div>
    </div>
  </div>
</div>
<!-- FIM MODAL DE CRIAÇÃO DE SENHA -->
    
