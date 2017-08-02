<?php
namespace AppBundle\Entity;

/**
 * Trait containing common entity methods and properties
 *
 * @package AppBundle\Entity
 */
trait EntityTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }
}