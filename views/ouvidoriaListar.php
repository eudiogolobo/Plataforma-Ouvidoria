<?php 
// Retoma sessão e inclui arquivos (verificação se está logado e header)
session_start();
include_once __DIR__."/../Web/isLogged.php";
include_once __DIR__."/layout/layoutStart.php";
?>


<!-- COMEÇO MODAL DE FILES -->
<div class="modal fade modal-lg" id="modal-view-files" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="content p-4 row g-3 m-3">
            <div class="col-10 col-sm-11 col-md-11">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Anexos</h1> 
            </div>
            <div class="col-2 col-sm-1 col-md-1" style="display: flex; align-items: center;">
                <button type="button" style="margin-left: auto;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <hr>
            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                <table id="table-files" class="table table-striped table-hover caption-top">
                <caption id="count-data-files"></caption>
                    <thead >     
                        <tr>
                            <th class="d-none d-sm-table-cell">Nome</th>
                            <th  class="d-none d-lg-table-cell">Extensão</th>
                            <th  class="d-none d-lg-table-cell">Ação</th>
                        </tr>
                    </thead>
                    <tbody id="data-files"></tbody>
                
                </table>
            </div>

            
        </div>
      </div>
    </div>
  </div>
</div>
<!-- FIM MODAL DE FILES -->

<!-- INICIO PÁGINA Minhas Ouvidorias Abertas -->
<div class="container">
    <div class="row mt-5">
        <h1 class="mb-4">Minhas Ouvidorias Abertas</h1>
 
       
        <div class="col-9 col-sm-10 col-md-8 col-lg-6">
            <label for="textSearch" class="form-label">Pesquisar</label>
            <input id="textSearch" type="text" class="form-control" placeholder="Descrição, serviço afetado...">
        </div>
        <div class="col-2 col-sm-1 col-md-1 col-lg-1" style="align-items: end; display: flex;">
            <button title="Pesquisar" id="search" class="btn btn-success" style="height: 38px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </button>
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
           <p class="mt-5" id="p-status">Nenhum resultado encontrado...</p>
            <table id="table-search-ombudsman" class="table table-striped table-hover mt-5 caption-top">
            <caption id="count-data-search"></caption>
                <thead >     
                    <tr>
                        <th class="d-none d-sm-table-cell">Descrição do Caso</th>
                        <th  class="d-none d-lg-table-cell">Tipo de Serviço Afetado</th>
                        <th  class="d-none d-lg-table-cell">Anexos</th>
                    </tr>
                </thead>
                <tbody id="data-search-ombudsman">
                    
                    
                </tbody>
            
            </table>
        </div>

           
      
       
   </div>
</div>
<!-- FIM PÁGINA Minhas Ouvidorias Abertas -->

<script>

    // Função para carregar os anexos quando o usuário apertar no 
    // botão de visualizar anexos da tabela de pesquisa
    function loadFilesOmbudsman(ombudsman_id)
    {
        $.ajax({
            url: "../web/loadFilesOmbudsman.php",
            type: "GET",
            data:{'ombudsman_id': ombudsman_id},
            success: (response)=>{
              
                   //Limpa o HTML do TBody da tabela
                    $('#data-files').html('')

                    // Constrói o tbody da tabela de anexos
                    $.each(response.data, function(index, value){

                    htmlData = "<tr>";

                    htmlData += '<td>' + value.name + '</td>';

                    htmlData += '<td>.' + value.extension + '</td>';

                    htmlData += '<td style="justify-content:center;vertical-align: middle; ">  <button title="Baixar" onclick="baixarArq64(\''+value.name+'\' , \''+value.extension+'\' , \''+value.attachment+'\' )" style="display:flex;justify-content:center;padding:5px 5px;margin:0" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-file-earmark-arrow-down-fill" viewBox="0 0 16 16"><path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0M9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1m-1 4v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 11.293V7.5a.5.5 0 0 1 1 0"/></svg></button></td>';

                    htmlData += "</tr>";

                     // Incremento o HTML de cada item do resultado na tebela
                    $('#data-files').append(htmlData)
                   
                    })
                    // Add a quantidade de resultados de anexos dessa ouvidoria aberta
                    $('#count-data-files').html('Total de anexos: '+response.data.length)
               
            },
            error: ()=>{

            },
        })
    }

    // Função para o usuário baixar os arquivos das ouvidorias
    function baixarArq64(name, extensao, base64)
    {
        var link = document.createElement("a");
        document.body.appendChild(link);
        link.setAttribute("type", "hidden");
        link.href = "data:text/plain;base64," + base64;
        link.download = name+"."+extensao;
        link.click();
        document.body.removeChild(link);
    }

    // Quando o documento carregar totalmente 
    $(document).ready(()=>{

        // Add a classe de active no link da ouvidoria
        $('#link-ouvidoria').addClass('active');

        // Chama a função para listar as ouvidorias abertas desse usuário
        searchOmbudsman()

        // Toda vez que clicar em pesquisar ele realiza a função de pesquisa
        $('#search').click(()=>{
            searchOmbudsman();
        })
    })


    // Funçao de pesquisa
    function searchOmbudsman()
    {
       // Faz a requisição AJAX passando por parâmetro o texto do input de pesquisa
       // e retorna os resultados
        
        $.ajax({
            url: "../web/searchOmbudsman.php",
            type: "GET",
            data:{'textSearch': $('#textSearch').val()} ,
            success: (response)=>{
                // Vê se retornou algo
                if(response.data.length > 0)
                {
                    //Limpa o HTML do TBody da tabela
                    $('#data-search-ombudsman').html('')

                    //Esconde o texto de que nada foi encontrado
                    $('#p-status').css('display','none')

                    //Adiciona a vizualização da tabela
                    $('#table-search-ombudsman').css('display','table')

                    // Controi o TBody com os resultados
                    $.each(response.data, function(index, value){

                    htmlData = "<tr>";

                    htmlData += '<td>' + value.description + '</td>';

                    htmlData += '<td>' + value.service_type + '</td>';

                    htmlData += '<td style="justify-content:center;vertical-align: middle; ">  <button title="Ver Anexos" onclick="loadFilesOmbudsman('+value.id+')" data-bs-target="#modal-view-files" data-bs-toggle="modal" class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/></svg></button></td>';

                    htmlData += "</tr>";

                    // Incrementa o HTML com os resultados desse item
                    $('#data-search-ombudsman').append(htmlData)
                    })

                    // Passa a quantidade de registros totais
                    $('#count-data-search').html('Qtd. de resultados: '+response.data.length)

                } else{

                    // Limpa o html do TBody
                    $('#data-search-ombudsman').html('')
                    // Mostra o texto de nenhum resultado encontrado
                    $('#p-status').css('display','block')
                    //Esconde a tabela ombudsman para mostrar somente o texto
                    $('#table-search-ombudsman').css('display','none')
                }
               
            },
           
        })
    }
</script>


<!-- INCLUI O FIM DO HTML -->
<?php
include_once __DIR__."/layout/layoutEnd.php";
?>