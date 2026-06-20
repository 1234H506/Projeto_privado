<?php

class Comentarios {
  private  $Id_usuario;
  private  $Sobre_assunto;
  private  $Texto_Inserido;

    public function __construct($Id_usuario,$Sobre_assunto,$Texto_Inserido){
          $this->Id_usuario = $Id_usuario;
          $this->Sobre_assunto = $Sobre_assunto;
          $this->Texto_Inserido = $Texto_Inserido;
    }
    
    public function salvar($conexao){
      $sql="INSERT INTO comentarios (ID_Utilizador,Analise,assunto) VALUES (?,?,?)";
      $stmt = $conexao->prepare($sql);
      $stmt->bind_param("iss", $this->Id_usuario,$this->Texto_Inserido,$this->Sobre_assunto);
      return $stmt->execute();
    }

    public function listar($conexao){
        $sqlListaComentarios = "SELECT c.assunto, c.Analise, u.Nome , u.Imagem FROM comentarios c, utilizador u WHERE c.ID_Utilizador=u.ID_Utilizador ORDER BY c.ID_comentario DESC";
        $stmt = $conexao->prepare($sqlListaComentarios);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function listarComentarioVisita($conexao,$id_imoveis){
        $sqlListaComentariosVisita = "SELECT u.Nome, u.Imagem , uhi.comentarios FROM utilizador_has_imoveis uhi , utilizador u , imoveis i WHERE uhi.Utilizador_ID_Utilizador=u.ID_Utilizador AND i.ID_Imoveis =uhi.Imoveis_ID_Imoveis AND i.ID_Imoveis = $id_imoveis ORDER BY uhi.id_registro DESC LIMIT 1";
        $stmt = $conexao->prepare($sqlListaComentariosVisita);
        $stmt->execute();
        return $stmt->get_result();
    }

}

?>