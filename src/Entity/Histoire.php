<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="histoire")
 */
class Histoire {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $titre;

    /**
     * @ORM\Column(type="text", length=500)
     */
    private $pitch;

    /**
     * @ORM\Column(type="string", length=256)
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Genre")
     */
    private $genre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $user;
    /**
     * @ORM\Column(type="boolean")
     */
    private $actif;

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
    public function getPitch() {
        return $this->pitch;
    }

    /**
     * @param mixed $pitch
     */
    public function setPitch($pitch): void {
        $this->pitch = $pitch;
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
    public function getGenre() {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre): void {
        $this->genre = $genre;
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
    public function getUser() {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getActif() {
        return $this->actif;
    }

    /**
     * @param mixed $actif
     */
    public function setActif($actif): void {
        $this->actif = $actif;
    }

    public function __toString(): string {
        // TODO: Implement __toString() method.
        return $this->getTitre();
    }

}