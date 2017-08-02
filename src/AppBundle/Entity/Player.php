<?php
namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;

class Player
{
    use EntityTrait;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Collection|Game[]|null
     */
    private $games;

    /**
     * Player constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Game[]|Collection|null
     */
    public function getGames()
    {
        return $this->games;
    }
}