<?php

namespace App\Models;

use App\Constants\Map;
use App\Contracts\GameObject;

class Coin extends GameObject
{

    /**
     * Criar inimigos
     *
     * @param mixed $count O número de inimigos a serem criados
     * @return array<coin>
     */
    static function generateCoins($count): array
    {
        $coin = [];

        for ($i = 0; $i < $count; $i++) {
            $coin[] = new Coin();
        }

        return $coin;
    }

    /**
     * Criar uma posição aleatória dentro dos limites do tabuleiro
     *
     * @return array<string,int>
     */
    public function createRandomPosition(): array
    {
        return [
            'x' => rand(0, Map::WIDTH - 1),
            'y' => rand(0, Map::HEIGHT - 1)
        ];
    }

    public function __construct()
    {

        [
            'x' => $x,
            'y' => $y
        ] = $this->createRandomPosition();

        // não carregar inimigos no mesmo ponto que o jogador
        while ($this->isCollidingWith(request()->route()->controller->player)) {
            // se foi gerado na mesma posição que o jogador,
            // refaz a posição
            [
                'x' => $x,
                'y' => $y
            ] = $this->createRandomPosition();
        }

        parent::__construct($x, $y);
    }
    public function render()
    {
        $css = "
        .tile-{$this->x()}-{$this->y()} {
            background-color: yellow;
        }
        ";

        echo $css;
    }

    /**
     * Movimenta a moeda para um lugar aleatorio
     * @return void
     */
//    public function setRandomDirection()
//    {
//        $coinMove = [$this->_x = rand(Map::WIDTH - 1, Map::WIDTH),
//                         $this->_y = rand(Map::WIDTH - 1, Map::WIDTH)
//        ];
//        $this->move($coinMove);
//    }
}
