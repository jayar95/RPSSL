<?php
namespace AppBundle\Game;

class Round
{
    /**
     * @var Hand
     */
    public $hand;

    /**
     * @var Hand
     */
    public $computerHand;

    /**
     * Round constructor.
     * @param $hand
     */
    public function __construct($hand)
    {
        $this->hand = $this->stringToHand($hand);

        $this->computerHand = $this->generateComputerHand();
    }

    /**
     * @return Hand
     */
    public function generateComputerHand(): Hand
    {
        $availableHands = HandMap::getAvailableHands();

        $hand = array_rand($availableHands);

        $bitValue = $availableHands[$hand];

        return new Hand($bitValue, $hand);
    }

    /**
     * @param $string
     * @return Hand
     */
    public function stringToHand($string): Hand
    {
        $hand = strtoupper($string);

        $bitValue = HandMap::getAvailableHands()[$hand];

        return new Hand($bitValue, $hand);
    }

    /**
     * HandMap::$map[$computer] will return an integer. The integer bits are
     * compared with the $player bits. If any bit match up, that means the
     * player played a hand matched in the bit map, and true boolean is returned
     * thus meaning the player lost.
     *
     * @return bool
     */
    public function playHand(): bool
    {
        $player = $this->hand->bit;

        $computer = $this->computerHand->bit;

        return (bool)($player & HandMap::$map[$computer]);
    }

    /**
     * @return string
     */
    public function result(): string
    {
        if ($this->hand->bit === $this->computerHand->bit) {
            return GameStatusConstants::DRAW;
        } elseif ($this->playHand()) {
            return GameStatusConstants::LOSS;
        }

        return GameStatusConstants::WIN;
    }
}