<?php

namespace App\Entity;

use App\Repository\SeasonRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SeasonRepository::class)
 */
class Season {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column (type="integer", length=3)
     */
    private $number;

    /**
     * @ORM\Column (type="date")
     */
    private $firstAirDate;

    /**
     * @ORM\Column (type="text", nullable=true)
     */
    private $overview;

    /**
     * @ORM\Column (type="string", length=255)
     */
    private $poster;

    /**
     * @ORM\Column (type="integer", unique=true)
     */
    private $tmdbId;

    /**
     * @ORM\Column (type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\Column (type="datetime", nullable=true)
     */
    private $dateModified;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Serie")
     */
    private $serie;

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number): void {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getFirstAirDate() {
        return $this->firstAirDate;
    }

    /**
     * @param mixed $firstAirDate
     */
    public function setFirstAirDate($firstAirDate): void {
        $this->firstAirDate = $firstAirDate;
    }

    /**
     * @return mixed
     */
    public function getOverview() {
        return $this->overview;
    }

    /**
     * @param mixed $overview
     */
    public function setOverview($overview): void {
        $this->overview = $overview;
    }

    /**
     * @return mixed
     */
    public function getPoster() {
        return $this->poster;
    }

    /**
     * @param mixed $poster
     */
    public function setPoster($poster): void {
        $this->poster = $poster;
    }

    /**
     * @return mixed
     */
    public function getTmdbId() {
        return $this->tmdbId;
    }

    /**
     * @param mixed $tmdbId
     */
    public function setTmdbId($tmdbId): void {
        $this->tmdbId = $tmdbId;
    }

    /**
     * @return mixed
     */
    public function getDateCreated() {
        return $this->dateCreated;
    }

    /**
     * @param mixed $dateCreated
     */
    public function setDateCreated($dateCreated): void {
        $this->dateCreated = $dateCreated;
    }

    /**
     * @return mixed
     */
    public function getDateModified() {
        return $this->dateModified;
    }

    /**
     * @param mixed $dateModified
     */
    public function setDateModified($dateModified): void {
        $this->dateModified = $dateModified;
    }

    /**
     * @return mixed
     */
    public function getSerie() {
        return $this->serie;
    }

    /**
     * @param mixed $serie
     */
    public function setSerie($serie): void {
        $this->serie = $serie;
    }


}
