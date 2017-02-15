<?php

namespace NB\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Travel
 *
 * @ORM\Table(name="travel")
 * @ORM\Entity(repositoryClass="NB\MainBundle\Repository\TravelRepository")
 */
class Travel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="NB\MainBundle\Entity\Route", cascade={"persist"})
     */
    private $route;

    /**
     * @ORM\ManyToOne(targetEntity="NB\MainBundle\Entity\Bus", cascade={"persist"})
     */
    private $bus;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="boardingTime", type="time")
     */
    private $boardingTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrivalTime", type="time")
     */
    private $arrivalTime;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="pickup_address", type="string", length=255)
     */
    private $pickupAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="drop_address", type="string", length=255)
     */
    private $dropAddress;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @ORM\ManyToMany(targetEntity="NB\MainBundle\Entity\Frequency", cascade={"persist"})
     */
    private $frequency;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    public function __construct(){
        $this->frequency = new ArrayCollection();
    }
    public function setFrequency(Frequency $frequency = null)
    {
        $this->frequency = $frequency;
    }

    // Notez le singulier, on ajoute une seule catégorie à la fois
    public function addFrequency(Frequency $frequency)
    {
        // Ici, on utilise l'ArrayCollection vraiment comme un tableau
        $this->frequency[] = $frequency;

        return $this;
    }

    public function removeFrequency(Frequency $frequency)
    {
        // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
        $this->frequency->removeElement($frequency);
    }

    // Notez le pluriel, on récupère une liste de catégories ici !
    public function getFrequency()
    {
        return $this->frequency;
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
     * Set route
     *
     * @param string $route
     *
     * @return Travel
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set bus
     *
     * @param string $bus
     *
     * @return Travel
     */
    public function setBus($bus)
    {
        $this->bus = $bus;

        return $this;
    }

    /**
     * Get bus
     *
     * @return string
     */
    public function getBus()
    {
        return $this->bus;
    }

    /**
     * Set boardingTime
     *
     * @param \DateTime $boardingTime
     *
     * @return Travel
     */
    public function setBoardingTime($boardingTime)
    {
        $this->boardingTime = $boardingTime;

        return $this;
    }

    /**
     * Get boardingTime
     *
     * @return \DateTime
     */
    public function getBoardingTime()
    {
        return $this->boardingTime;
    }

    /**
     * Set arrivalTime
     *
     * @param \DateTime $arrivalTime
     *
     * @return Travel
     */
    public function setArrivalTime($arrivalTime)
    {
        $this->arrivalTime = $arrivalTime;

        return $this;
    }

    /**
     * Get arrivalTime
     *
     * @return \DateTime
     */
    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Travel
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set pickupAddress
     *
     * @param string $pickupAddress
     *
     * @return Travel
     */
    public function setPickupAddress($pickupAddress)
    {
        $this->pickupAddress = $pickupAddress;

        return $this;
    }

    /**
     * Get pickupAddress
     *
     * @return string
     */
    public function getPickupAddress()
    {
        return $this->pickupAddress;
    }

    /**
     * Set dropAddress
     *
     * @param string $dropAddress
     *
     * @return Travel
     */
    public function setDropAddress($dropAddress)
    {
        $this->dropAddress = $dropAddress;

        return $this;
    }

    /**
     * Get dropAddress
     *
     * @return string
     */
    public function getDropAddress()
    {
        return $this->dropAddress;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Travel
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }



    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Travel
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Travel
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }


}

