<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Schip
 *
 * @ORM\Table(name="schip")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SchipRepository")
 */
class Schip
{

    /**
     * @ORM\OneToMany(targetEntity="CursusType", mappedBy="CursusType")
     */
    private $cursusType;

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
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="Averij", type="boolean", nullable=true)
     */
    private $averij;

    /**
     * @var int
     *
     * @ORM\Column(name="Capaciteit", type="integer")
     */
    private $capaciteit;


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
     * Set name
     *
     * @param string $name
     *
     * @return Schip
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set averij
     *
     * @param boolean $averij
     *
     * @return Schip
     */
    public function setAverij($averij)
    {
        $this->averij = $averij;

        return $this;
    }

    /**
     * Get averij
     *
     * @return bool
     */
    public function getAverij()
    {
        return $this->averij;
    }

    /**
     * Set capaciteit
     *
     * @param integer $capaciteit
     *
     * @return Schip
     */
    public function setCapaciteit($capaciteit)
    {
        $this->capaciteit = $capaciteit;

        return $this;
    }

    /**
     * Get capaciteit
     *
     * @return int
     */
    public function getCapaciteit()
    {
        return $this->capaciteit;
    }

    /**
     * Set cursusType
     *
     * @param \AppBundle\Entity\CursusType $cursusType
     *
     * @return Schip
     */
    public function setCursusType(\AppBundle\Entity\CursusType $cursusType = null)
    {
        $this->cursusType = $cursusType;

        return $this;
    }

    /**
     * Get cursusType
     *
     * @return \AppBundle\Entity\CursusType
     */
    public function getCursusType()
    {
        return $this->cursusType;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->schip = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add schip
     *
     * @param \AppBundle\Entity\Schip $schip
     *
     * @return Schip
     */
    public function addSchip(\AppBundle\Entity\Schip $schip)
    {
        $this->schip[] = $schip;

        return $this;
    }

    /**
     * Remove schip
     *
     * @param \AppBundle\Entity\Schip $schip
     */
    public function removeSchip(\AppBundle\Entity\Schip $schip)
    {
        $this->schip->removeElement($schip);
    }

    /**
     * Get schip
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSchip()
    {
        return $this->schip;
    }

    /**
     * Add cursusType
     *
     * @param \AppBundle\Entity\CursusType $cursusType
     *
     * @return Schip
     */
    public function addCursusType(\AppBundle\Entity\CursusType $cursusType)
    {
        $this->cursusType[] = $cursusType;

        return $this;
    }

    /**
     * Remove cursusType
     *
     * @param \AppBundle\Entity\CursusType $cursusType
     */
    public function removeCursusType(\AppBundle\Entity\CursusType $cursusType)
    {
        $this->cursusType->removeElement($cursusType);
    }
}
