<?php
namespace AppBundle\Entity;

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