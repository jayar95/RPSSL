<?php
namespace AppBundle\Entity;

class Game
{
    use EntityTrait;

    /**
     * @var Player
     */
    private $player;

    /**
     * @var string
     */
    private $playerHand;

    /**
     * @var string
     */
    private $computerHand;

    /**
     * @var string
     */
    private $outcome;

    /**
     * Game constructor.
     * @param Player $player
     * @param string $playerHand
     * @param string $computerHand
     * @param string $outcome
     */
    public function __construct(
        Player $player,
        $playerHand,
        $computerHand,
        $outcome
    ) {
        $this->player = $player;
        $this->playerHand = $playerHand;
        $this->computerHand = $computerHand;
        $this->outcome = $outcome;
    }

    /**
     * @return Player
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * @return string
     */
    public function getPlayerHand(): string
    {
        return $this->playerHand;
    }

    /**
     * @return string
     */
    public function getComputerHand(): string
    {
        return $this->computerHand;
    }

    /**
     * @return string
     */
    public function getOutcome(): string
    {
        return $this->outcome;
    }
}