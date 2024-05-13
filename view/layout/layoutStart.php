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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>


    <title><?=$title?></title>
</head>
<body>


<!-- carregar as cidades -->
  <script>

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
            }).change();		

        });



        //---------------------------------------------------------------------------------------------------------------------------------------//

        // add class active ao item do menu principal

        $('#link-main').addClass('active');

        $('#telephone').change(function(){
            let value = $('#telephone').val()
            if (!value) return ""
            value = value.replace(/\D/g,'')
            value = value.replace(/(\d{2})(\d)/,"($1) $2")
            value = value.replace(/(\d)(\d{4})$/,"$1-$2")
            return $('#telephone').val(val)
            
        })

    })

   

</script>

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
            </div>
            <div class="col-md-3">
                <label for="date_birth" class="form-label">Data de Nascimento</label>
                <input type="date" class="form-control" id="date_birth" name="date_birth">
            </div>
            <div class="col-md-3">
                <label for="telephone" class="form-label">Telefone</label>
                <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Telefone">
            </div>
            <div class="col-md-3">
                <label for="whatsapp" class="form-label">WhatsApp</label>
                <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp">
            </div>
            <div class="col-md-7">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" id="email" placeholder="E-mail">
            </div>
            <div class="col-md-2">
                <label for="fu" class="form-label">UF</label>
                <select name="fu" id="fu" class="form-select"></select>
            </div>
            <div class="col-md-5">
                <label for="city" class="form-label">Cidade</label>
                <select name="city" id="city" class="form-select"></select>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Senha</label>
                <input type="text" class="form-control" id="password" name="password" placeholder="Senha">
            </div>
            <div class="col-md-6">
                <label for="password_comnfirm" class="form-label">Confirm sua senha</label>
                <input type="text" class="form-control" id="password_comnfirm" name="password_comnfirm" placeholder="Confirme a senha">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" onmouseleave="" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
        <button id="btn-update-password" type="button" class="btn btn-primary">Próximo</button>
      </div>
    </div>
  </div>
</div>
<!-- FIM MODAL DE CADASTRO -->
    
