<!-- Funções auxiliares para o HomeSpace -->



<!-- Número de telemóvel formatado -->
<?php 
function num_Formatado ($numero){
    $Nr_formatado = substr($numero, 0, 3) . "-" . substr($numero, 3, 3) . "-" . substr($numero, 6, 3);

    return $Nr_formatado;
}

?>


<!-- Função para preço do imóvel -->
 <?php 
 function preco_formatado($preco_atual_formatado,$acao){
  if($acao=="Vendas") {
    $preco_atual_formatado = number_format($preco_atual_formatado, 2, ',', '.');
  }else{
    $preco_atual_formatado = number_format($preco_atual_formatado, 2, ',', '.') . " /por mês" ;
  }
return $preco_atual_formatado;
 } 
 ?>

 <!-- Data formatada no arquivo A_agente_property-details.php -->
<?php
function Data_formatada($parametro){
  $date = new DateTime($parametro);
  return $date->format("d/m/Y");
}
?>


 <!-- Class/Object para A_agente_property-details.php e depois usar isso na função para mostra esse dados  -->
<?php 
class Dados_Imoveis{
    //Propriedades
    public string $morada;
    public float $preco;
    public string $tipologia;
    public string $garagem;
    public float $area;
    public string $concelho;
    public string $distrito;
    public string $comentario;
    public string $registro;
    public array $imagens;

    // métodos 
    function __construct($morada,$preco,$tipologia,$garagem,$area,$concelho,$distrito,$comentario,$registro,$imagens){
        $this->morada = $morada;
        $this->preco = $preco;
        $this->tipologia = $tipologia;
        $this->garagem = $garagem;
        $this->area = $area;
        $this->concelho = $concelho;
        $this->distrito = $distrito;
        $this->comentario = $comentario;
        $this->registro = $registro;
        $this->imagens = (array)$imagens;
    }
}
?>
