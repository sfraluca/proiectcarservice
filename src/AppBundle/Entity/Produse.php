<?php

namespace AppBundle\Entity;

/**
 * Produse
 */
class Produse
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $descriere;

    /**
     * @var string
     */
    private $pret;


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
     * Set descriere
     *
     * @param string $descriere
     *
     * @return Produse
     */
    public function setDescriere($descriere)
    {
        $this->descriere = $descriere;

        return $this;
    }

    /**
     * Get descriere
     *
     * @return string
     */
    public function getDescriere()
    {
        return $this->descriere;
    }

    /**
     * Set pret
     *
     * @param string $pret
     *
     * @return Produse
     */
    public function setPret($pret)
    {
        $this->pret = $pret;

        return $this;
    }

    /**
     * Get pret
     *
     * @return string
     */
    public function getPret()
    {
        return $this->pret;
    }
    private $categorie;
}

