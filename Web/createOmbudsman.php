<?php
include_once __DIR__."/../configuration/connect.php";
//
//$description =$_POST['description'];
//$service_type = $_POST['service_type'];
session_start();
$database = new Database();
$database->connection();
 //UPLOAD DE ARQUIVO  VINDO DO FORMULÁRIO
 $files = $_FILES["files"];	
 $id = 1;	
 $contador = sizeof($_FILES["files"]["tmp_name"]);
 if($_FILES["files"]["error"][0] != 4)
 {
     //configurando array de verificação back-end de tamanho e tipo do arquivo a ser enviado.
     // Tamanho máximo do arquivo (em Bytes)
         $_verifica['tamanho'] = 1024 * 1024 * 2; // 2Mb	
     // Array com as extensões permitidas
         $_verifica['extensoes'] = array('xlsx','xls','csv','txt','pdf','rar','zip','jpg','jpeg','png');
                                         
     if($contador >= 10)
     die("falha na inserção do arquivo no banco");	
     
     $i = 0;
     foreach($files as $file)
     {
         if($i < $contador)
         {
             $file_tmp = $_FILES["files"]["tmp_name"][$i]; //NOME DO ARQUIVO NO COMPUTADOR
             $file_name = $_FILES["files"]["name"][$i];
             $file_size = $_FILES["files"]["size"][$i]; 
             $file_type = $_FILES["files"]["type"][$i];
             $partes = explode(".", $file_name);
             $extensao = end($partes);


             ////verificando a extensão.
             //$extensao = strtolower(end(explode('.', $_FILES['upload-file']['name'])));
             if (array_search($extensao, $_verifica['extensoes']) === false) {
                 die('falha na inserção do arquivo no banco 1');
             }
             // Faz a verificação do tamanho do arquivo
             else if ($_verifica['tamanho'] < $file_size) {
                 die('falha na inserção do arquivo no banco 2');
             }

             
             
           
           
             
             $binario = file_get_contents($file_tmp); // evitamos erro de sintaxe do MySQL
            $base64 = base64_encode($binario);
            $img = 'data:image/'.$extensao.';base64,'.$base64;
             //FIM DO UPLOAD DE ARQUIVO
                         
             $insert_arquivo = $database->pdo->prepare("INSERT INTO attachments(ombudsman_id, attachment) VALUES (:id, :img)");
             $insert_arquivo->bindValue(':id',$id);
             $insert_arquivo->bindValue(':img',$img);
             $result_insert_arquivo = $insert_arquivo->execute();
             if(!$result_insert_arquivo)
             {
                 die('falha na inserção do arquivo no banco');
                 
             } else{
                echo "ok".$i;
             }
         }	
             
         $i++;
     }
 }	


?>