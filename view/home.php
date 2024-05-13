<?php require_once __DIR__ ."/layout/layoutStart.php" ?>

<div class="container p-3">

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
   
    <table class="table">
       
        <thead>     
            <tr>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($users as $item){ ?>
            
            <tr><td><?php echo $item['name']; ?></td></tr>
            
            <?php } ?>
           
        </tbody>
        
    </table>

</div>


   
    
<?php require_once __DIR__ ."/layout/layoutEnd.php" ?>