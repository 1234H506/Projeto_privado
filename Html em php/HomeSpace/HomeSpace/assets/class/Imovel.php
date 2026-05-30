<?php 
class Imovel {

    public function __construct(
        private ? int $id,
        private ? string $imagem_principal,
        private ? string $moradia, 
        private ? int $preco,
        private ? string $tipologia,
        private ? string $dt_de_registro,
        private ? string $comentario,
        private ? float $area,
        private ? string $estado

    )
    {}
}
?> 