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
}

?>