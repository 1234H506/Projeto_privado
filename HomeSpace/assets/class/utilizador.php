<?php 
class utilizador {
   
    public function __construct(
        private ? int $id,
        private ? string $nome,
        private ?string $telemovel,
        private string $email,
        private ?int $admin,
        private ?int $sexo,
        private ?string $imagem,
          
    ) {}

    public static function Validacao_De_Recuperacao_De_Senha(string $emailExistente,mysqli $conexao){
        $sqlVerificacao = "SELECT Email FROM utilizador WHERE Email = ?";
        $stmt = $conexao->prepare($sqlVerificacao);
        $stmt->bind_param("s", $emailExistente);
        $stmt->execute();
        $variavel = $stmt->get_result();
        if($variavel->num_rows === 1){
                $stmt->close();
                return true;
            }else{
                $stmt->close();
                return false;
            }
    }
}
?>