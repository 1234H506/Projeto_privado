<?php 

class visitas{
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function completed_visits(){
        $sql1 = "SELECT COUNT(id_registro) as total FROM `utilizador_has_imoveis` WHERE resultado = 'vendido'";
        $stmt1 = $this->conn->prepare($sql1);
        $stmt1->execute();
        $result1 = $stmt1->get_result();
        $row1 = $result1->fetch_assoc();
        

        $sql2 = "SELECT COUNT(id_registro) as total FROM `utilizador_has_imoveis`";
        $stmt2 = $this->conn->prepare($sql2);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $row2 = $result2->fetch_assoc();

        return ($row1['total']/$row2['total'])*100;
    }
}
    
?>