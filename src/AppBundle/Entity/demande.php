<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * demande
 */
class demande
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
     * @var personne
     */
    private $personne;

    /**
     * @var ArrayCollection
     */
    private $propositions;


    public function __construct()
    {
        $this->propositions = new ArrayCollection();
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
     * @return demande
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
     * @return demande
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
     * @return demande
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

    public function isCompleted() {

        foreach($this->propositions as $proposition) {
            if($proposition->isStatut())
                return true;
        }

        return false;
    }

    /**
     * @return ArrayCollection
     */
    public function getPropositions()
    {
        return $this->propositions;
    }

    /**
     * @param ArrayCollection $propositions
     */
    public function setPropositions($propositions)
    {
        $this->propositions = $propositions;
    }

    public function addProposition($proposition) {

        $this->propositions[] = $proposition;

        return $this;
    }
}
