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
}
