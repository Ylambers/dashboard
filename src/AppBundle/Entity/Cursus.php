<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cursus
 *
 * @ORM\Table(name="cursus")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CursusRepository")
 */
class Cursus
{
    /**
     * @ORM\ManyToOne(targetEntity="CursusType", inversedBy="cursus")
     * @ORM\JoinColumn(name="Cursus_type", referencedColumnName="id")
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
     * @var \DateTime
     *
     * @ORM\Column(name="datum", type="date")
     */
    private $datum;

    /**
     * @var string
     *
     * @ORM\Column(name="naam", type="string", length=255)
     */
    private $naam;

    /**
     * @var integer
     *
     * @ORM\Column(name="personen", type="integer", length=255)
     */
    private $personen;

    /**
     * @var string
     *
     * @ORM\Column(name="beschrijving", type="text")
     */
    private $beschrijving;


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
     * Set datum
     *
     * @param \DateTime $datum
     *
     * @return Cursus
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Set naam
     *
     * @param string $naam
     *
     * @return Cursus
     */
    public function setNaam($naam)
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * Get naam
     *
     * @return string
     */
    public function getNaam()
    {
        return $this->naam;
    }

    /**
     * Set beschrijving
     *
     * @param string $beschrijving
     *
     * @return Cursus
     */
    public function setBeschrijving($beschrijving)
    {
        $this->beschrijving = $beschrijving;

        return $this;
    }

    /**
     * Get beschrijving
     *
     * @return string
     */
    public function getBeschrijving()
    {
        return $this->beschrijving;
    }

    /**
     * Set cursusType
     *
     * @param \AppBundle\Entity\CursusType $cursusType
     *
     * @return Cursus
     */
    public function setCursusType(\AppBundle\Entity\CursusType $cursusType = null)
    {
        $this->cursusType = $cursusType;

        return $this;
    }

    /**
     * Get cursusType
     *
     * @return \CursusBundle\Entity\CursusType
     */
    public function getCursusType()
    {
        return $this->cursusType;
    }

    /**
     * Set personen
     *
     * @param integer $personen
     *
     * @return Cursus
     */
    public function setPersonen($personen)
    {
        $this->personen = $personen;

        return $this;
    }

    /**
     * Get personen
     *
     * @return integer
     */
    public function getPersonen()
    {
        return $this->personen;
    }
}
