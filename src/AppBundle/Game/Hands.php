<?php
namespace AppBundle\Game;

final class Hands
{
    const ROCK = 'ROCK';
    const PAPER = 'PAPER';
    const SCISSORS = 'SCISSORS';
    const SPOCK = 'SPOCK';
    const LIZARD = 'LIZARD';
    const MAP = [
        self::ROCK => [
            self::LIZARD,
            self::SPOCK,
        ],
        self::PAPER => [
            self::ROCK,
            self::LIZARD,
        ],
        self::SCISSORS => [
            self::PAPER,
            self::ROCK,
        ],
        self::SPOCK => [
            self::SCISSORS,
            self::PAPER,
        ],
        self::LIZARD => [
            self::SPOCK,
            self::SCISSORS,
        ],
    ];

    /**
     * @return array
     */
    public static function getAvailableHands(): array
    {
        return (new \ReflectionClass(self::class))->getConstants();
    }
}