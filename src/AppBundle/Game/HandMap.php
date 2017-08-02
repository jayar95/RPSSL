<?php
namespace AppBundle\Game;

final class HandMap
{
    const ROCK = 1;
    const PAPER = 2;
    const SCISSORS = 4;
    const SPOCK = 8;
    const LIZARD = 16;

    /**
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