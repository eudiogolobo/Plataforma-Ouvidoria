<?php 
session_start();
include_once __DIR__."/../Web/isLogged.php";
include_once __DIR__."/layout/layoutStart.php";
?>

<style>
  
</style>
<div class="container">
    <div class="row mt-5">
        <h1 class="mb-4">Minhas Ouvidorias Abertas</h1>
 
       
        <div class="col-9 col-sm-10 col-md-8 col-lg-6">
            <label for="textSearch" class="form-label">Pesquisar</label>
            <input id="textSearch" type="text" class="form-control" placeholder="Descrição, serviço afetado...">
        </div>
        <div class="col-2 col-sm-1 col-md-1 col-lg-1" style="align-items: end; display: flex;">
            <button id="search" class="btn btn-success" style="height: 38px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </button>
        </div>

        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
           <p class="mt-5" id="p-status">Nenhum resultado encontrado...</p>
            <table id="table-search-ombudsman" class="table table-striped table-hover mt-5">
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


<script>
    $(document).ready(()=>{
        $('#link-ouvidoria').addClass('active');
        searchOmbudsman()
        $('#search').click(()=>{
            searchOmbudsman();
        })
    })


    function searchOmbudsman()
    {
       
        $.ajax({
            url: "../web/searchOmbudsman.php",
            type: "GET",
            data:{'textSearch': $('#textSearch').val()} ,
            success: (response)=>{
                if(response.data.length > 0)
                {
                    $('#data-search-ombudsman').html('')
                    $('#p-status').css('display','none')
                    $('#table-search-ombudsman').css('display','table')
                    $.each(response.data, function(index, value){

                    htmlData = "<tr>";

                    htmlData += '<td>' + value.description + '</td>';

                    htmlData += '<td>' + value.service_type + '</td>';

                    htmlData += '<td style="justify-content:center;vertical-align: middle; ">  <button class="btn btn-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16"><path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/><path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/></svg></button></td>';

                    htmlData += "</tr>";
                    $('#data-search-ombudsman').append(htmlData)
                    })

                } else{
                    $('#data-search-ombudsman').html('')
                    $('#p-status').css('display','block')
                    $('#table-search-ombudsman').css('display','none')
                }
               
            },
            error: ()=>{

            },
        })
    }
</script>

<?php
include_once __DIR__."/layout/layoutEnd.php";
?>