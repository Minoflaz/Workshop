<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * proposition
 */
class proposition
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $titre;

    /**
     * @var string
     */
    private $texte;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var boolean
     */
    private $statut;

    /**
     * @var personne
     */
    private $personne;

    /**
     * @var demande
     */
    private $demande;


    public function __construct()
    {
        $this->statut = false;
        $this->demande = null;
        $this->date = new \DateTime();
    }


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
     * Set titre
     *
     * @param string $titre
     *
     * @return proposition
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set texte
     *
     * @param string $texte
     *
     * @return proposition
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return proposition
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param $personne
     * @return $this
     */
    public function setPersonne($personne)
    {
        $this->personne = $personne;

        return $this;
    }

    /**
     * @return personne
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * @return demande
     */
    public function getDemande()
    {
        return $this->demande;
    }

    /**
     * @param demande $demande
     */
    public function setDemande($demande)
    {
        $this->demande = $demande;
    }


}
