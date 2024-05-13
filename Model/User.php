<?php
class User extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->connection();
        
    }
    public function fetch()
    {
        $stm = $this->pdo->query('SELECT * FROM users');

        if($stm->rowCount() > 0)
        {
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        } else{
            return [];
        }
     
    }
}
?>