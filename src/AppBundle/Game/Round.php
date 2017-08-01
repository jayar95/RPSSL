<?php
namespace AppBundle\Game;

class Round
{
    private $hand;

    private $computerHand;

    public function __construct($hand)
    {
        $this->hand = strtoupper($hand);
        $this->computerHand = $this->generateComputerHand();
    }

    /**
     * @return string
     */
    public function generateComputerHand(): string
    {
        return array_rand(Hands::getAvailableHands(), 1);
    }

    /**
     * @return string|\Exception
     */
    public function result()
    {
        if ($this->hand === $this->computerHand)
        {
            return GameStatusConstants::DRAW;
        }
        elseif (in_array($this->hand, Hands::MAP[$this->computerHand]))
        {
            return GameStatusConstants::LOSS;
        }
        elseif (in_array($this->computerHand, Hands::MAP[$this->hand])) {
            return GameStatusConstants::WIN;
        }

        return new \Exception('Invalid Hand Played');
    }
}