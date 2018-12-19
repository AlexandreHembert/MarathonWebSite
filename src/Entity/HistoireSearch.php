<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HistoireSearchRepository")
 */
class HistoireSearch
{
    /**
     * @var ArrayCollection
     */
    private $genres;


    public function __construct()
    {
        $this->genres = new ArrayCollection();
    }


    /**
     * @return ArrayCollection
     */
    public function getGenres(): ArrayCollection
    {
        return $this->genres;
    }

    /**
     * @param ArrayCollection $genres
     */
    public function setGenres(ArrayCollection $genres)
    {
        $this->genres = $genres;
    }


}
