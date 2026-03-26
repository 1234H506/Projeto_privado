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
    }

    public function Imoveis_Do_Agentes($Id_Agentes){
        
    }
?>