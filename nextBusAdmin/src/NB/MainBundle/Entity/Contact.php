<?php

namespace NB\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="NB\MainBundle\Repository\ContactRepository")
 */
class Contact
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
     * @ORM\Column(name="service_client", type="string", length=255)
     */
    private $serviceClient;

    /**
     * @var string
     *
     * @ORM\Column(name="email_service_client", type="string", length=255)
     */
    private $emailServiceClient;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set serviceClient
     *
     * @param string $serviceClient
     *
     * @return Contact
     */
    public function setServiceClient($serviceClient)
    {
        $this->serviceClient = $serviceClient;

        return $this;
    }

    /**
     * Get serviceClient
     *
     * @return string
     */
    public function getServiceClient()
    {
        return $this->serviceClient;
    }

    /**
     * Set emailServiceClient
     *
     * @param string $emailServiceClient
     *
     * @return Contact
     */
    public function setEmailServiceClient($emailServiceClient)
    {
        $this->emailServiceClient = $emailServiceClient;

        return $this;
    }

    /**
     * Get emailServiceClient
     *
     * @return string
     */
    public function getEmailServiceClient()
    {
        return $this->emailServiceClient;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Contact
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
     * @return Contact
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
}

