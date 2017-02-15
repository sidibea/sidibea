<?php

namespace NB\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use NB\MainBundle\Entity\Travel;

/**
 * Reservation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="NB\MainBundle\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="NB\MainBundle\Entity\Travel", cascade={"persist"})
     */
    private $travel;

    /**
     * @var \string
     *
     * @ORM\Column(name="doj", type="string", length=14)
     */
    private $doj;

    /**
     * @var \string
     *
     * @ORM\Column(name="dor", nullable=true, type="string", length=14)
     */
    private $dor;

    /**
     * @var boolean
     *
     * @ORM\Column(name="confirmed", type="boolean")
     */
    private $confirmed;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_add", type="datetime")
     */
    private $dateAdd;

    /**
     * @var integer
     *
     * @ORM\Column(name="seats", type="integer")
     */
    private $seats;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_upd", type="datetime")
     */
    private $dateUpd;

    /**
     * @var string
     *
     * @ORM\Column(name="channel", type="string", length=255)
     */
    private $channel;

    /**
     * @var string
     *
     * @ORM\Column(name="channel_id",  type="integer")
     */
    private $channel_id;


    /**
     * @ORM\ManyToOne(targetEntity="NB\MainBundle\Entity\Ticket", cascade={"persist", "remove"})
     */
    private $tickets;


    public function setTickets(Ticket $ticket )
    {
        $this->tickets = $ticket;
    }



    // Notez le pluriel, on récupère une liste de catégories ici !
    public function getTickets()
    {
        return $this->tickets;
    }



    public function __construct(){
        //$this->tickets = new ArrayCollection();
        //$this->dateAdd = new \datetime;
        $this->dateUpd = new \Datetime;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    public function setTravel(Travel $travel)
    {
        $this->travel = $travel;

        return $this;
    }

    /**
     * Get travel
     *
     * @return string
     */
    public function getTravel()
    {
        return $this->travel;
    }

    /**
     * Set confirmed
     *
     * @param boolean $confirmed
     * @return Reservation
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;

        return $this;
    }

    /**
     * Get confirmed
     *
     * @return boolean
     */
    public function getConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * Set dateAdd
     *
     * @param \DateTime $dateAdd
     * @return Reservation
     */
    public function setDateAdd($dateAdd)
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    /**
     * Get dateAdd
     *
     * @return \DateTime
     */
    public function getDateAdd()
    {
        return $this->dateAdd;
    }




    /**
     * @return string
     */
    public function getDoj()
    {
        return $this->doj;
    }

    /**
     * @param string $doj
     */
    public function setDoj($doj)
    {
        $this->doj = $doj;
    }

    /**
     * @return boolean
     */
    public function isUpDown()
    {
        return $this->upDown;
    }

    /**
     * @param boolean $upDown
     */
    public function setUpDown($upDown)
    {
        $this->upDown = $upDown;
    }

    /**
     * @return \DateTime
     */
    public function getDateUpd()
    {
        return $this->dateUpd;
    }

    /**
     * @param \DateTime $dateUpd
     */
    public function setDateUpd($dateUpd)
    {
        $this->dateUpd = $dateUpd;
    }

    /**
     * @return string
     */
    public function getDor()
    {
        return $this->dor;
    }

    /**
     * @param string $dor
     */
    public function setDor($dor)
    {
        $this->dor = $dor;
    }

    /**
     * @return int
     */
    public function getSeats()
    {
        return $this->seats;
    }

    /**
     * @param int $seats
     */
    public function setSeats($seats)
    {
        $this->seats = $seats;
    }

    /**
     * @param string $channel
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
    }

    /**
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param string $channel_id
     */
    public function setChannelId($channel_id)
    {
        $this->channel_id = $channel_id;
    }

    /**
     * @return string
     */
    public function getChannelId()
    {
        return $this->channel_id;
    }














}
