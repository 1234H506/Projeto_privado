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

    public function DadosAgentes($conexao){
        $agentes = "SELECT a.ID_Agentes,a.nome , a.NdeTelemovel , a.Servicos , a.Email , a.Imagem , i.concelho FROM agentes a , imoveis i WHERE i.Agentes_ID_Agentes=a.ID_Agentes AND a.disponibilidades = 1 LIMIT 4";
        $stmt = $conexao->prepare($agentes);
        $stmt->execute();
        return $stmt->get_result();
    }

    }
?>