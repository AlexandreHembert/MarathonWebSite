<?php
/**
 * Created by PhpStorm.
 * User: hemery
 * Date: 2018-12-06
 * Time: 18:42
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**

 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\SuiteRepository")
 */
class Suite {
   /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $reponse;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chapitre", inversedBy="suites" )
     */
    private $chapitreSource;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Chapitre")
     */
    private $chapitreDestination;

    /**
     * @return mixed
     */
    public function getReponse() {
        return $this->reponse;
    }

    /**
     * @param mixed $reponse
     */
    public function setReponse($reponse): void {
        $this->reponse = $reponse;
    }

    /**
     * @return mixed
     */
    public function getChapitreSource() {
        return $this->chapitreSource;
    }

    /**
     * @param mixed $chapitreSource
     */
    public function setChapitreSource($chapitreSource): void {
        $this->chapitreSource = $chapitreSource;
    }

    /**
     * @return mixed
     */
    public function getChapitreDestination() {
        return $this->chapitreDestination;
    }

    /**
     * @param mixed $chapitreDestination
     */
    public function setChapitreDestination($chapitreDestination): void {
        $this->chapitreDestination = $chapitreDestination;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }


}