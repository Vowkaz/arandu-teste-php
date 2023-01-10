<?php

namespace App\Contracts;

use App\Constants\Map;
use App\Constants\Movement;

abstract class GameObject
{
    private $_x;
    private $_y;


    public function __construct(int $x, int $y)
    {
        $this->_x = $x;
        $this->_y = $y;
    }

    /**
     * Retorna a posição 'X' no tabuleiro
     *
     * @return int
     */
    public function x(): int
    {
        return $this->_x;
    }

    /**
     * Retorna a posição 'Y' no tabuleiro
     * @return int
     */
    public function y(): int
    {
        return $this->_y;
    }

    /**
     * Detecta se o objeto está na mesma casa que o objeto passado
     *
     * @param GameObject $object Objeto para detectar a colisão
     * @return bool
     */
    public function isCollidingWith(GameObject $object): bool
    {
        return $this->_x === $object->_x && $this->_y === $object->_y;
    }

    /**
     * Move o objeto na direção especificada
     *
     * @param string $direction 'ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'
     * @return void
     */
    public function move(string $direction): void
    {

        switch ($direction) {
            case Movement::arrowUp:
                $this->_y--;
                $this->validLimit();
                break;

            case Movement::arrowDown:
                $this->_y++;
                $this->validLimit();
                break;

            case Movement::arrowLeft:
                $this->_x--;
                $this->validLimit();
                break;

            case Movement::arrowRight:
                $this->_x++;
                $this->validLimit();
                break;

            default:
                # code...
                break;
        }
    }

    /**
     * Move o objeto para a posição especificada
     *
     * @param int $x
     * @param int $y
     * @return void
     */
    public function moveTo(int $x, int $y): void
    {
        $this->_x = $x;
        $this->_y = $y;
    }

    public function validLimit(): void
    {
        if ($this->_x === Map::WIDTH) {
            $this->_x = 0;
        }
        if ($this->_y === Map::HEIGHT) {
            $this->_y = 0;
        }
        if ($this->_x === -1) {
            $this->_x = Map::WIDTH - 1;
        }
        if ($this->_y === -1) {
            $this->_y = Map::HEIGHT - 1;
        }
    }

    /**
     * Imprime um CSS para adicionar estilo à casa do tabuleiro em que o objeto está.
     *
     * @return void
     */
    abstract function render();
}
