<?php
namespace AppBundle\Game;

class Hand
{
    /**
     * @var int
     */
    public $bit;

    /**
     * @var string
     */
    public $name;

    /**
     * Hand constructor.
     * @param int $bit
     * @param string $name
     */
    public function __construct($bit, $name)
    {
        $this->bit = $bit;
        $this->name = $name;
    }
}