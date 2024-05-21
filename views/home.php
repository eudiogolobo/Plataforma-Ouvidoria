<?php 
session_start();
require_once __DIR__ ."/layout/layoutStart.php";
?>
<!-- INICIO HTML HOME -->
   

    <div class="container p-3">
    <h2 class="mt-5" style="text-decoration: underline;">Como se cadastrar:</h2>
        <ul class="mt-5">
            <li class="">
                <h4>Passo 01:</h4>
                <ul style="list-style: none;" class="mt-2 mb-4">
                    <li>
                        <p>Clique em cadastrar-se no menu superior à direita.</p> 
                        <p class="mt-3"> (Opção cadastrar-se no menu superior à direita) <br> <img style="background-color: black; padding: 2px;border-radius: 5px;" class="mt-2" width="500" src="../public/img/entrarCadastrar.png" alt=""></p>
                    </li>
                </ul> 
              
            </li>
            
            <li class="mt-5"><h4>Passo 02:</h4>
                <ul style="list-style: none;" class="mt-2 mb-4">
                    <li>
                        <p>Preencha todos os campos e aperte em Próximo.</p>
                        <p class="mt-3"> ( Menu->Cadastrar-se ) <br> <img style="background-color: black; padding: 2px;border-radius: 5px;" class="mt-2" width="500" src="../public/img/cad1.png" alt=""></p> 
                    </li>
                </ul>   
            </li>
            
            <li class="mt-5"><h4>Passo 03:</h4> 
                <ul style="list-style: none;" class="mt-2 mb-4">
                    <li>
                        <p>Preencha o campo senha, confirme a senha e clique em Próximo.</p>
                        <p><img style="background-color: black; padding: 2px;border-radius: 5px;" class="mt-2" width="500" src="../public/img/cad2.png" alt=""></p>
                        <p>Pronto, seu cadastro foi feito! (mas não está ativo ainda)</p>
                    </li>
                </ul>
            </li>
            <li class="mt-5"><h4>Passo 04:</h4> 
                <ul style="list-style: none;" class="mt-2 mb-4">
                    <li>
                        <p>Cole o código de verificação que foi enviado para o seu endereço de e-mail no campo "Código". Em seguida aperte em Enviar.</p>
                        <p><img style="background-color: black; padding: 2px;border-radius: 5px;" class="mt-2" width="500" src="../public/img/cad3.png" alt=""></p>
                        <p>Pronto, seu cadastro foi ativado com sucesso!</p>
                    </li>
                </ul>
            </li>
        </ul>
        <h2 class="mt-5" style="text-decoration: underline;">Como abrir uma chamada para ouvidoria:</h2>
        <ul class="mt-5">
            <li class="">
                <h4>Passo 01:</h4>
                <ul style="list-style: none;" class="mt-2 mb-4">
                    <li>
                        <p>Entre ou cadastre-se em nosso portal. Caso já tenha realizado o cadastro mas não terminou a etapa de verificação, tente se cadastrar com o mesmo e-mail para ser redirecionado para a verificação do mesmo.</p> 
                        <p class="mt-3"> (Opção entrar ou cadastrar-se no menu superior à direita) <br> <img style="background-color: black; padding: 2px;border-radius: 5px;" class="mt-2" width="500" src="../public/img/entrarCadastrar.png" alt=""></p>
                    </li>
                </ul> 
              
            </li>
            
            <li class="mt-5"><h4>Passo 02:</h4>
                <ul style="list-style: none;" class="mt-2 mb-4">
                    <li>
                        <p>Abra um novo chamado para a ouvidoria.</p>
                        <p class="mt-3"> ( Menu->Ouvidoria->Nova ) <br> <img style="background-color: black; padding: 2px;border-radius: 5px;" class="mt-2" width="500" src="../public/img/criar-ouvidoria.png" alt=""></p> 
                        <p><img style="background-color: black; padding: 2px;border-radius: 5px;" class="mt-2" width="500" src="../public/img/nova-ouvidoria.png" alt=""></p>
                    </li>
                </ul>   
            </li>
            
            <li class="mt-5"><h4>Passo 03:</h4> 
                <ul style="list-style: none;" class="mt-2 mb-4">
                    <li>
                        <p>Preencha todos os campos e anexe no mínimo 1 (um) arquivo e no máximo 9 (nove) arquivos, em seguida, aperte em Enviar.</p>
                        <p> (Extensões permitidas: .xlsx, .xls, .csv, .txt, .pdf, .rar, .zip, .jpg, .jpeg, .png)</p>
                        <p class="mt-3">(os arquivos devem ter menos de 2Mb.)</p>
                        <p><img style="background-color: black; padding: 2px;border-radius: 5px;" class="mt-2" width="500" src="../public/img/enviar-ouvidoria.png" alt=""></p>
                        <p>Pronto, você abriu um chamado!</p>
                    </li>
                </ul>
            </li>
        </ul>
        <h2 class="mt-5" style="text-decoration: underline;">Como ver meus chamados abertos:</h2>
        <ul class="mt-5">
            <li class="">
                <h4>Passo 01:</h4>
                <ul style="list-style: none;" class="mt-2 mb-4">
                    <li>
                        <p>Entre ou cadastre-se em nosso portal. Caso já tenha realizado o cadastro mas não terminou a etapa de verificação, tente se cadastrar com o mesmo e-mail para ser redirecionado para a verificação do mesmo.</p> 
                        <p class="mt-3"> (Opção entrar ou cadastrar-se no menu superior à direita) <br> <img style="background-color: black; padding: 2px;border-radius: 5px;" class="mt-2" width="500" src="../public/img/entrarCadastrar.png" alt=""></p>
                    </li>
                </ul> 
              
            </li>
            
            <li class="mt-5"><h4>Passo 02:</h4>
                <ul style="list-style: none;" class="mt-2 mb-4">
                    <li>
                        <p>Visualize seus chamados já feitos.</p>
                        <p class="mt-3"> ( Menu->Ouvidoria->Ver Minhas ) <br> <img style="background-color: black; padding: 2px;border-radius: 5px;" class="mt-2" width="500" src="../public/img/criar-ouvidoria.png" alt=""></p> 
                        <p><img style="background-color: black; padding: 2px;border-radius: 5px;" class="mt-2" width="500" src="../public/img/menu-ver-minhas.png" alt=""></p>
                        <p>Pronto, agora você consegue ver seus chamados abertos!</p>
                    </li>
                </ul>   
            </li>
        </ul>
        <h2 class="mt-5" style="text-decoration: underline;">Como baixar os anexos dos meus chamados já abertos:</h2>
        <ul class="mt-5">
            <li class="">
                <h4>Passo 01:</h4>
                <ul style="list-style: none;" class="mt-2 mb-4">
                    <li>
                        <p>Entre ou cadastre-se em nosso portal. Caso já tenha realizado o cadastro mas não verificou a conta com o código de verificação enviado no e-mail cadastrado, realize o mesmo cadastro com o mesmo e-mail que quando tentar enviar vai perguntar se quer que mande outro código de verificação para realizar assim o ativamento e finalização do cadastro.</p> 
                        <p class="mt-3"> (Opção entrar ou cadastrar-se no menu superior à direita) <br> <img style="background-color: black; padding: 2px;border-radius: 5px;" class="mt-2" width="500" src="../public/img/entrarCadastrar.png" alt=""></p>
                    </li>
                </ul> 
              
            </li>
            
            <li class="mt-5"><h4>Passo 02:</h4>
                <ul style="list-style: none;" class="mt-2 mb-4">
                    <li>
                        <p>Visualize seus chamados já feitos.</p>
                        <p class="mt-3"> ( Menu->Ouvidoria->Ver Minhas ) <br> <img style="background-color: black; padding: 2px;border-radius: 5px;" class="mt-2" width="500" src="../public/img/criar-ouvidoria.png" alt=""></p> 
                        <p><img style="background-color: black; padding: 2px;border-radius: 5px;" class="mt-2" width="500" src="../public/img/menu-ver-minhas.png" alt=""></p>
                    </li>
                </ul>   
            </li>
            <li class="mt-5"><h4>Passo 03:</h4>
                <ul style="list-style: none;" class="mt-2 mb-4">
                    <li>
                        <p>Click no ícone de Visualizar.</p>
                        <p class="mt-3"> <br> <img style="background-color: black; padding: 2px;border-radius: 5px;" class="mt-2" width="500" src="../public/img/ver-anexos.png" alt=""></p> 
                       
                    </li>
                </ul>   
            </li>
            <li class="mt-5"><h4>Passo 04:</h4>
                <ul style="list-style: none;" class="mt-2 mb-4">
                    <li>
                        <p>Click no ícone de Download.</p>
                        <p class="mt-3"> <br> <img style="background-color: black; padding: 2px;border-radius: 5px;" class="mt-2" width="500" src="../public/img/baixar-anexo.png" alt=""></p> 
                        <p>Pronto, agora você tem seu anexo baixado!</p>
                    </li>
                </ul>   
            </li>
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