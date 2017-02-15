<?php

namespace NB\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bus
 *
 * @ORM\Table(name="bus")
 * @ORM\Entity(repositoryClass="NB\MainBundle\Repository\BusRepository")
 */
class Bus
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
     * @var string
     *
     * @ORM\Column(name="regno", type="string", length=255)
     */
    private $regno;

    /**
     * @var string
     *
     * @ORM\Column(name="brand", type="string", length=255)
     */
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity="NB\MainBundle\Entity\Company", cascade={"persist", "remove"})
     */
    private $company;

    /**
     * @var int
     *
     * @ORM\Column(name="capacity", type="integer")
     */
    private $capacity;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;



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

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;

    /**
     * @var bool
     *
     * @ORM\Column(name="wifi", type="boolean")
     */
    private $wifi;

    /**
     * @var bool
     *
     * @ORM\Column(name="tele", type="boolean")
     */
    private $tele;

    /**
     * @var bool
     *
     * @ORM\Column(name="music", type="boolean")
     */
    private $music;

    /**
     * @var bool
     *
     * @ORM\Column(name="nourriture", type="boolean")
     */
    private $nourriture;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getUniqueName(){
        return $this->getCompany()->getNom()."=>".$this->getRegno()."(".$this->capacity.")";
    }

    /**
     * Set regno
     *
     * @param string $regno
     *
     * @return Bus
     */
    public function setRegno($regno)
    {
        $this->regno = $regno;

        return $this;
    }

    /**
     * Get regno
     *
     * @return string
     */
    public function getRegno()
    {
        return $this->regno;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return Bus
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     *
     * @return Bus
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return int
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set confort
     *
     * @param string $confort
     *
     * @return Bus
     */
    public function setConfort($confort)
    {
        $this->confort = $confort;

        return $this;
    }

    /**
     * Get confort
     *
     * @return string
     */
    public function getConfort()
    {
        return $this->confort;
    }

    /**
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param string $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return boolean
     */
    public function isWifi()
    {
        return $this->wifi;
    }

    /**
     * @param boolean $wifi
     */
    public function setWifi($wifi)
    {
        $this->wifi = $wifi;
    }

    /**
     * @return boolean
     */
    public function isTele()
    {
        return $this->tele;
    }

    /**
     * @param boolean $tele
     */
    public function setTele($tele)
    {
        $this->tele = $tele;
    }

    /**
     * @return boolean
     */
    public function isMusic()
    {
        return $this->music;
    }

    /**
     * @param boolean $music
     */
    public function setMusic($music)
    {
        $this->music = $music;
    }

    /**
     * @return boolean
     */
    public function isNourriture()
    {
        return $this->nourriture;
    }

    /**
     * @param boolean $nourriture
     */
    public function setNourriture($nourriture)
    {
        $this->nourriture = $nourriture;
    }



    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Bus
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
     * @return Bus
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
     * Set active
     *
     * @param boolean $active
     *
     * @return Bus
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
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }


}

