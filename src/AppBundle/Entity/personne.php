<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * personne
 */
class personne implements UserInterface, \Serializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
     */
    private $prenom;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $ville;

    /**
     * @var int
     */
    private $numeroTelephone;

    /**
     * @var array
     */
    private $competences;

    /**
     * @var array
     */
    private $propositions;

    /**
     * @var array
     */
    private $demandes;

    /**
     * @var array
     */
    private $role;


    public function __construct()
    {
        $this->username = "";
        $this->password = "";
        $this->nom = "";
        $this->prenom = "";
        $this->email = "";
        $this->ville = "";
        $this->numeroTelephone = 0;

        $this->competences = new ArrayCollection();
        $this->propositions = new ArrayCollection();
        $this->demandes = new ArrayCollection();

        $this->role = array('ROLE_USER');
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

    public function addCompetence($competence){

        $this->competences[] = $competence;

        return $this;
    }

    public function addProposition($proposition){

        $proposition->setPersonne($this);
        $this->propositions[] = $proposition;

        return $this;
    }

    public function addDemande($demande){

        $demande->setPersonne($demande);
        $this->demandes[] = $demande;

        return $this;
    }

    /**
     * Set pseudo
     *
     * @param string $username
     *
     * @return personne
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set pass
     *
     * @param string $password
     *
     * @return personne
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return personne
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return personne
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return personne
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return personne
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }


    /**
     * Set numeroTelephone
     *
     * @param integer $numeroTelephone
     *
     * @return personne
     */
    public function setNumeroTelephone($numeroTelephone)
    {
        $this->numeroTelephone = $numeroTelephone;

        return $this;
    }

    /**
     * Get numeroTelephone
     *
     * @return int
     */
    public function getNumeroTelephone()
    {
        return $this->numeroTelephone;
    }

    public function setRoles($roles) {

        $this->role = $roles;
        return $this;
    }

    public function getRoles()
    {
        return $this->role;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function eraseCredentials()
    {
    }


    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }
}
