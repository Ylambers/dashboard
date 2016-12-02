<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CursusType
 *
 * @ORM\Table(name="cursus_type")
 * @ORM\Entity(repositoryClass="CursusBundle\Repository\CursusTypeRepository")
 */
class CursusType
{
    /**
     * @ORM\OneToMany(targetEntity="Cursus", mappedBy="cursustype")
     */
    private $cursus;

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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="prijs", type="string", length=255)
     */
    private $prijs;

    /**
     * @var string
     *
     * @ORM\Column(name="beschrijving", type="text")
     */
    private $beschrijving;

    /**
     * @var int
     *
     * @ORM\Column(name="boten", type="integer")
     */
    private $boten;


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
     * Set title
     *
     * @param string $title
     *
     * @return CursusType
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set prijs
     *
     * @param string $prijs
     *
     * @return CursusType
     */
    public function setPrijs($prijs)
    {
        $this->prijs = $prijs;

        return $this;
    }

    /**
     * Get prijs
     *
     * @return string
     */
    public function getPrijs()
    {
        return $this->prijs;
    }

    /**
     * Set beschrijving
     *
     * @param string $beschrijving
     *
     * @return CursusType
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
     * Set boten
     *
     * @param integer $boten
     *
     * @return CursusType
     */
    public function setBoten($boten)
    {
        $this->boten = $boten;

        return $this;
    }

    /**
     * Get boten
     *
     * @return int
     */
    public function getBoten()
    {
        return $this->boten;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cursus = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add cursus
     *
     * @param \CursusBundle\Entity\Cursus $cursus
     *
     * @return CursusType
     */
    public function addCursus(\CursusBundle\Entity\Cursus $cursus)
    {
        $this->cursus[] = $cursus;

        return $this;
    }

    /**
     * Remove cursus
     *
     * @param \CursusBundle\Entity\Cursus $cursus
     */
    public function removeCursus(\CursusBundle\Entity\Cursus $cursus)
    {
        $this->cursus->removeElement($cursus);
    }

    /**
     * Get cursus
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCursus()
    {
        return $this->cursus;
    }
}
