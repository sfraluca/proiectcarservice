<?php

namespace AppBundle\Entity;

/**
 * Categorie
 */
class Categorie
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $titlu;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titlu
     *
     * @param string $titlu
     *
     * @return Categorie
     */
    public function setTitlu($titlu)
    {
        $this->titlu = $titlu;

        return $this;
    }

    /**
     * Get titlu
     *
     * @return string
     */
    public function getTitlu()
    {
        return $this->titlu;
    }
    private $produse;

    public function __construct()
    {
        $this->produse = new ArrayCollection();
    }
}

