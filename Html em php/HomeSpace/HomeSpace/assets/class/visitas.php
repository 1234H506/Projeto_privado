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
    public function pending_visits($id_utilizador){
        $sql = "SELECT * FROM `utilizador_has_imoveis` uhi , imoveis i , agentes a , utilizador u WHERE uhi.Utilizador_ID_Utilizador=u.ID_Utilizador AND uhi.Imoveis_ID_Imoveis = i.ID_Imoveis AND uhi.Agentes_ID_Agentes = a.ID_Agentes AND uhi.Utilizador_ID_Utilizador = $id_utilizador AND uhi.data >= NOW() AND uhi.Status_de_visita != 'cancelado'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
    
?>