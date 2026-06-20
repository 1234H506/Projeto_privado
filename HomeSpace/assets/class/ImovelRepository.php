<?php
class ImovelRepository{

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getTodos(){
        $sql = "SELECT i.*,a.nome,a.NdeTelemovel,a.Servicos,a.Imagem FROM imoveis i INNER JOIN agentes a ON i.Agentes_ID_Agentes = a.ID_Agentes WHERE i.Disponibilidade = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result(); 
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMaisRecente(){
        $sql = "SELECT i.*,a.nome,a.NdeTelemovel,a.Servicos,a.Imagem as 'agente' FROM imoveis i INNER JOIN agentes a ON i.Agentes_ID_Agentes = a.ID_Agentes WHERE i.Disponibilidade = 1  ORDER BY i.ID_imoveis DESC LIMIT 1 ";
        $stmt = $this->conn ->prepare($sql);
        $stmt ->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    public function active_real_estate(){
        $sql = "SELECT COUNT(ID_Imoveis) as total FROM `imoveis` WHERE Disponibilidade = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function propertties_sold(){
        $sql = "SELECT COUNT(id_registro) as total FROM `utilizador_has_imoveis` WHERE resultado = 'vendido'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    public function getFotosImovel($idImovel, $limite = 2){
    $sql = "SELECT Fotos 
            FROM galeria 
            WHERE Imoveis_ID_Imoveis = ? 
            ORDER BY ID_Galeria ASC 
            LIMIT ?";
            
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $idImovel, $limite);
    $stmt->execute();
    $result = $stmt->get_result();
    
    return $result->fetch_all(MYSQLI_ASSOC);
}
    
}

?>