<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvisRepository")
 */
class Avis
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $positif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Histoire", inversedBy="avis")
     */
    private $histoires;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="avis")
     */
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPositif(): ?bool
    {
        return $this->positif;
    }

    public function setPositif(bool $positif): self
    {
        $this->positif = $positif;

        return $this;
    }

    public function getHistoires(): ?Histoire
    {
        return $this->histoires;
    }

    public function setHistoires(?Histoire $histoires): self
    {
        $this->histoires = $histoires;

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->users;
    }

    public function setUsers(?User $users): self
    {
        $this->users = $users;

        return $this;
    }
}