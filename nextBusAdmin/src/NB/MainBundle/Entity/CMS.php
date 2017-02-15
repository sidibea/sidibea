<?php

namespace NB\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CMS
 *
 * @ORM\Table(name="c_m_s")
 * @ORM\Entity(repositoryClass="NB\MainBundle\Repository\CMSRepository")
 */
class CMS
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
     * @ORM\Column(name="reseau_national", type="text")
     */
    private $reseauNational;

    /**
     * @var string
     *
     * @ORM\Column(name="reseau_international", type="text")
     */
    private $reseauInternational;

    /**
     * @var string
     *
     * @ORM\Column(name="horaire", type="text")
     */
    private $horaire;

    /**
     * @var string
     *
     * @ORM\Column(name="why_nextbus", type="text")
     */
    private $whyNextbus;

    /**
     * @var string
     *
     * @ORM\Column(name="acheter_billet", type="text")
     */
    private $acheterBillet;

    /**
     * @var string
     *
     * @ORM\Column(name="modifier_billet", type="text")
     */
    private $modifierBillet;

    /**
     * @var string
     *
     * @ORM\Column(name="preparer_voyage", type="text")
     */
    private $preparerVoyage;

    /**
     * @var string
     *
     * @ORM\Column(name="bus_nuit", type="text")
     */
    private $busNuit;


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
     * Set reseauNational
     *
     * @param string $reseauNational
     *
     * @return CMS
     */
    public function setReseauNational($reseauNational)
    {
        $this->reseauNational = $reseauNational;

        return $this;
    }

    /**
     * Get reseauNational
     *
     * @return string
     */
    public function getReseauNational()
    {
        return $this->reseauNational;
    }

    /**
     * Set reseauInternational
     *
     * @param string $reseauInternational
     *
     * @return CMS
     */
    public function setReseauInternational($reseauInternational)
    {
        $this->reseauInternational = $reseauInternational;

        return $this;
    }

    /**
     * Get reseauInternational
     *
     * @return string
     */
    public function getReseauInternational()
    {
        return $this->reseauInternational;
    }

    /**
     * Set horaire
     *
     * @param string $horaire
     *
     * @return CMS
     */
    public function setHoraire($horaire)
    {
        $this->horaire = $horaire;

        return $this;
    }

    /**
     * Get horaire
     *
     * @return string
     */
    public function getHoraire()
    {
        return $this->horaire;
    }

    /**
     * Set whyNextbus
     *
     * @param string $whyNextbus
     *
     * @return CMS
     */
    public function setWhyNextbus($whyNextbus)
    {
        $this->whyNextbus = $whyNextbus;

        return $this;
    }

    /**
     * Get whyNextbus
     *
     * @return string
     */
    public function getWhyNextbus()
    {
        return $this->whyNextbus;
    }

    /**
     * Set acheterBillet
     *
     * @param string $acheterBillet
     *
     * @return CMS
     */
    public function setAcheterBillet($acheterBillet)
    {
        $this->acheterBillet = $acheterBillet;

        return $this;
    }

    /**
     * Get acheterBillet
     *
     * @return string
     */
    public function getAcheterBillet()
    {
        return $this->acheterBillet;
    }

    /**
     * Set modifierBillet
     *
     * @param string $modifierBillet
     *
     * @return CMS
     */
    public function setModifierBillet($modifierBillet)
    {
        $this->modifierBillet = $modifierBillet;

        return $this;
    }

    /**
     * Get modifierBillet
     *
     * @return string
     */
    public function getModifierBillet()
    {
        return $this->modifierBillet;
    }

    /**
     * Set preparerVoyage
     *
     * @param string $preparerVoyage
     *
     * @return CMS
     */
    public function setPreparerVoyage($preparerVoyage)
    {
        $this->preparerVoyage = $preparerVoyage;

        return $this;
    }

    /**
     * Get preparerVoyage
     *
     * @return string
     */
    public function getPreparerVoyage()
    {
        return $this->preparerVoyage;
    }

    /**
     * Set busNuit
     *
     * @param string $busNuit
     *
     * @return CMS
     */
    public function setBusNuit($busNuit)
    {
        $this->busNuit = $busNuit;

        return $this;
    }

    /**
     * Get busNuit
     *
     * @return string
     */
    public function getBusNuit()
    {
        return $this->busNuit;
    }
}

