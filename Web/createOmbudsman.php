<?php
include_once __DIR__."/../configuration/connect.php";
	

// Tamanho máximo dos arquivos permitidos (em Bytes)
$_verifica['tamanho'] = 1024 * 1024 * 2; // 2Mb	

// Array com as extensões permitidas
$_verifica['extensoes'] = array('xlsx','xls','csv','txt','pdf','rar','zip','jpg','jpeg','png');
                     
// se a quantidade de files enviada for maior que 9 ele retorna um erro pois 
// só vou deixar 9 anexos...
if(count($_FILES["files"]["name"]) >= 10)
{
    header('HTTP/1.1 500 Internal Server');
    header('Content-Type: application/json; charset=UTF-8');
    return die(json_encode(array('title'=>'Envio Negado','message' => 'Máximo de arquivos permitidos por vez (9).')));	
}

// loop para percorrer todos os files
for($i = 0; $i < count($_FILES["files"]["name"]); $i++)
{
        // pego o nome do file na posição $i
        $file_name = $_FILES["files"]["name"][$i];
        // pego o tamanho do file na posição $i
        $file_size = $_FILES["files"]["size"][$i]; 
         // divido o nome do arquivo em duas partes (nome, extensão)
        $partes = explode(".", $file_name);
        // passo a extensão pegando o ultimo item do array $partes
        $extensao = end($partes);

        // verifica a extensão do arquivo de acordo com os permitidos no array $_verifica['extensoes']
        // retorna um erro se não for nenhuma das extensões setadas em $_verifica['extensoes']
        if (array_search($extensao, $_verifica['extensoes']) === false) {
        
            header('HTTP/1.1 500 Internal Server');
            header('Content-Type: application/json; charset=UTF-8');
             die(json_encode(array('title'=>'Envio Negado','message' => "Tipo(s) de arquivo(s) não suportado. \n\n Suportado: (xlsx, xls, csv, txt, pdf, rar, zip, jpg, jpeg, png).")));	
        }
       
        // Faz a verificação do tamanho do arquivo. Tem que ser menor que 2Mb setado em $_verifica['tamanho']
        // retorna um erro se não for menor que 2Mb setado em $_verifica['tamanho']
        else if ($_verifica['tamanho'] < $file_size) {
            header('HTTP/1.1 500 Internal Server');
            header('Content-Type: application/json; charset=UTF-8');
             die(json_encode(array('title'=>'Envio Negado','message' => 'Um de seu(s) arquivo(s) ultrapassa o temanho permitido. Máximo permitido 2Mb')));	
        }	
        
}

echo "cheguei no start";

session_start();
$database = new Database();
$database->connection();


$description = $_POST['description'];
$service_type = $_POST['service_type'];
$user_id = $_SESSION['id'];	

 $data_ombudsman = $database->pdo->prepare('INSERT INTO ombudsman (user_id, description, service_type) VALUES (:user_id , :description, :service_type );');
 $data_ombudsman->bindValue(':user_id', $user_id );
 $data_ombudsman->bindValue(':description',$description);
 $data_ombudsman->bindValue(':service_type',$service_type);
 $data_ombudsman->execute();
 $ombudsman_id =  $database->pdo->lastInsertId();


//UPLOAD DE ARQUIVO  VINDO DO FORMULÁRIO

 if($_FILES["files"]["error"][0] != 4)
 {
    for($i = 0; $i < count($_FILES["files"]["name"]); $i++)
    {
            // pego o nome do file na posição $i
            $file_name = $_FILES["files"]["name"][$i];
            // pego o tamanho do file na posição $i
            $file_size = $_FILES["files"]["size"][$i]; 
            // divido o nome do arquivo em duas partes (nome, extensão)
            $partes = explode(".", $file_name);
            // passo a extensão pegando o ultimo item do array $partes
            $extensao = end($partes);

            $name = $partes[0];


            $file_tmp = $_FILES["files"]["tmp_name"][$i]; //NOME DO ARQUIVO NO COMPUTADOR

            $binario = file_get_contents($file_tmp); // evitamos erro de sintaxe do MySQL
            $base64 = base64_encode($binario);
            //$img = 'data:image/'.$extensao.';base64,'.$base64;
                         
             $insert_arquivo = $database->pdo->prepare("INSERT INTO attachments(ombudsman_id, attachment, name, extension) VALUES (:ombudsman_id, :base64, :name, :extension)");
             $insert_arquivo->bindValue(':ombudsman_id',$ombudsman_id);
             $insert_arquivo->bindValue(':base64',$base64);
             $insert_arquivo->bindValue(':name', $name);
             $insert_arquivo->bindValue(':extension',$extensao);
             $result_insert_arquivo = $insert_arquivo->execute();
             if(!$result_insert_arquivo)
             {
                 die('falha na inserção do arquivo no banco');
                 
             } else{
                echo "ok".$i;
             }
       
     }
 }	


?>