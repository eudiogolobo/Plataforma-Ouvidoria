<?php 
session_start();
require_once __DIR__ ."/layout/layoutStart.php";
?>

<!-- COMEÇO MODAL DE LISTAGEM OUVIDORIA -->
<div class="modal fade modal-lg" id="modal-list-ouvidoria" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Minhas Ouvidorias</h1> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="content p-4 row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Pesquisar</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Buscar...">
                <div id="validation-name"></div>
            </div>
            <div class="col-md-3" style="margin-top: auto;">
                <button class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </button>
            </div>
            <table class="table">
                <theader>
                    <tr>
                        <th>Descrição</th>
                        <th>Tipo de serviço</th>
                    </tr>
                    <tbody>
                        <?php foreach($data as $item){ 
                            echo "<tr><td>". $item['name'] ."</td><td>". $item['date_birth'] ."</td></tr>";
                        }?>
                    </tbody>
                </theader>
            </table>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- FIM MODAL DE LISTAGEM OUVIDORIA -->

<div class="container mt-5">

    <h1 class="mt-3">Portal de ouvidoria | Criciúma/SC</h1>

    <div class="container p-3">
        <h5>Como usar este recurso</h5>
        <ul>
            <li>Passo 01:</li>
            <ul style="list-style: none;" class="mt-2 mb-4">
                <li>Entre ou cadastre-se no nosso portal. (Opção entrar ou cadastrar-se no menu superior à direita) <img src="#" alt=""></li>
            </ul>
            <li>Passo 02:</li>
            <ul style="list-style: none;" class="mt-2 mb-4">
                <li>Abra um novo chamado.<img src="#" alt=""></li>
            </ul>
            <li>Passo 03:</li>
            <ul style="list-style: none;" class="mt-2 mb-4">
                <li>Coloque os documentos em anexo caso necessário.<img src="#" alt=""></li>
            </ul>
            <li>Passo 04:</li>
            <ul style="list-style: none;" class="mt-2 mb-4">
                <li>Confirme o envio.<img src="#" alt=""></li>
            </ul>
        </ul>
    </div>
</div>

<script>
      // add class active ao item do menu principal
      $('#link-main').addClass('active');
</script>

<?php require_once __DIR__ ."/layout/layoutEnd.php" ?>