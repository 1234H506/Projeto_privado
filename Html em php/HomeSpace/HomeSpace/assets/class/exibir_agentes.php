<?php 
    class Exibir_agentes{
      public function __construct(
        public string $nome,
        public string $imagem,
        public string $concelho,
        public string $acao,
        public string $email,
        public string $telemovel
    ){}

    public function DadosAgentes($conexao,$limite = null){
        $agentes = "SELECT a.ID_Agentes, a.nome, a.NdeTelemovel, a.Servicos, a.Email, a.Imagem, i.concelho 
            FROM agentes a 
            INNER JOIN imoveis i ON i.Agentes_ID_Agentes = a.ID_Agentes 
            WHERE a.disponibilidades = 1 
            GROUP BY a.ID_Agentes";

        // Se o limite for passado , adicionamos à query
        if($limite !== null && is_int($limite)){
            $agentes .= " LIMIT " . $limite;
        }

        $stmt = $conexao->prepare($agentes);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function AgenteUnico($conexao,$id){
        $agentes_e_imoveis = "SELECT a.nome, a.NdeTelemovel, a.Servicos, a.Email, a.Imagem,a.Servicos, i.concelho 
            FROM agentes a , imoveis i
            WHERE a.Id_Agentes = i.Agentes_ID_Agentes AND a.disponibilidades = 1 AND a.ID_Agentes = $id";

        $stmt = $conexao->prepare($agentes_e_imoveis);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function contagemDeImoveis($conexao,$id){
        $Sql_contagem_imovel = "SELECT COUNT(*) as total FROM imoveis WHERE Agentes_ID_Agentes = $id";
        $stmt = $conexao->prepare($Sql_contagem_imovel);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $linha = $resultado->fetch_assoc();
        return $linha['total'];

    }

    public function contagemDeVisitasFeitas($conexao,$id){
        $Sql_contagem_visitas = "SELECT COUNT(*) as total_visitas FROM utilizador_has_imoveis WHERE Agentes_ID_Agentes = $id";
        $stmt = $conexao->prepare($Sql_contagem_visitas);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $linha = $resultado->fetch_assoc();
        return $linha['total_visitas'];
    }

    public function active_agents($conexao){
        $sql = "SELECT COUNT(ID_Agentes) as total FROM `agentes` ";
        $stmt = $conexao->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['total'];
    }


    }
?>