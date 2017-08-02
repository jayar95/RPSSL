<?php
namespace AppBundle\Game;

/**
 * Each potential hand is represented by the binary sequence seen in the
 * constant values below.
 * 
 * @package AppBundle\Game
 */
final class HandMap
{
    const ROCK = 1;
    const PAPER = 2;
    const SCISSORS = 4;
    const SPOCK = 8;
    const LIZARD = 16;

    /**
     * A bit map used to store the computations for which hands are beat by a
     * hand. The value of each key (a hand) is a decimal result from the OR bit
     * operation of the potentials hands the key can beat.
     *
     * @var array
     */
    public static $map = [
        self::ROCK => self::SCISSORS | self::LIZARD,
        self::PAPER => self::ROCK | self::SPOCK,
        self::SCISSORS => self::PAPER | self::LIZARD,
        self::SPOCK => self::SCISSORS | self::ROCK,
        self::LIZARD => self::SPOCK | self::PAPER,
    ];

    /**
     * @return array
     */
    public static function getAvailableHands(): array
    {
        return (new \ReflectionClass(self::class))->getConstants();
    }
}