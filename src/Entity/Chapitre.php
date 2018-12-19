<?php
/**
 * Created by PhpStorm.
 * User: hemery
 * Date: 2018-12-06
 * Time: 18:32
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Chapitre
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ChapitreRepository")
 */
class Chapitre {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=1000)
     */
    private $texte;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $titreCourt;

    /**
     * @ORM\Column(type="string", length=256)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=256, nullable=true)
     */
    private $question;

    /**
     * @var boolean
     * @ORM\Column(type="smallint")
     */
    private $premier;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Histoire")
     */
    private $histoire;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Suite", mappedBy="chapitreDestination")
     */
    private $suites;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Suite", mappedBy="chapitreSource")
     */
    private $origines;

    /**
     * Chapitre constructor.
     */
    public function __construct() {
        $this->suites = new ArrayCollection();
        $this->origines = new ArrayCollection();
    }


    /**
     * @return mixed
     */
    public function getTexte() {
        return $this->texte;
    }

    /**
     * @param mixed $texte
     */
    public function setTexte($texte): void {
        $this->texte = $texte;
    }

    /**
     * @return mixed
     */
    public function getTitre() {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre): void {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getPhoto() {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo): void {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getQuestion() {
        return $this->question;
    }

    /**
     * @param mixed $question
     */
    public function setQuestion($question): void {
        $this->question = $question;
    }

    /**
     * @return bool
     */
    public function isPremier(): ?bool {
        return $this->premier;
    }

    /**
     * @param bool $premier
     */
    public function setPremier(bool $premier): void {
        $this->premier = $premier;
    }

    /**
     * @return mixed
     */
    public function getHistoire() {
        return $this->histoire;
    }

    /**
     * @param mixed $histoire
     */
    public function setHistoire($histoire): void {
        $this->histoire = $histoire;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getSuites() {
        return $this->suites;
    }

    /**
     * @param mixed $suites
     */
    public function setSuites($suites): void {
        $this->suites = $suites;
    }

    /**
     * @return mixed
     */
    public function getOrigines() {
        return $this->origines;
    }

    /**
     * @param mixed $origines
     */
    public function setOrigines($origines): void {
        $this->origines = $origines;
    }

    /**
     * @return mixed
     */
    public function getTitreCourt() {
        return $this->titreCourt;
    }

    /**
     * @param mixed $titreCourt
     */
    public function setTitreCourt($titreCourt): void {
        $this->titreCourt = $titreCourt;
    }

    public function __toString() {
        // TODO: Implement __toString() method.
        return $this->getTitre();
    }


}