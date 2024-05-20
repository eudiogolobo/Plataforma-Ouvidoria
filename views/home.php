<?php 
session_start();
require_once __DIR__ ."/layout/layoutStart.php";
?>
<!-- INICIO HTML HOME -->
   

    <div class="container p-3">
        <h1 class="mt-5">Portal de ouvidoria | Criciúma/SC</h1>
        <h5 class="mt-4">Como usar este recurso</h5>
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
<!-- FIM HTML HOME -->
<script>
      // add class active ao item do menu principal
      // quando carregar o html todo
      $(document).ready(()=>{
        $('#link-main').addClass('active');
      })
     
</script>

<?php require_once __DIR__ ."/layout/layoutEnd.php" ?>