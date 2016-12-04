<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CursusRegistrations
 *
 * @ORM\Table(name="cursus_registrations")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CursusRegistrationsRepository")
 */
class CursusRegistrations
{
    /**
     * @ORM\ManyToOne(targetEntity="cursus", inversedBy="cursus")
     * @ORM\JoinColumn(name="cursus", referencedColumnName="id")
     */
    private $cursus;


    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="user")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


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
     * Set cursus
     *
     * @param \AppBundle\Entity\cursus $cursus
     *
     * @return CursusRegistrations
     */
    public function setCursus(\AppBundle\Entity\cursus $cursus = null)
    {
        $this->cursus = $cursus;

        return $this;
    }

    /**
     * Get cursus
     *
     * @return \AppBundle\Entity\cursus
     */
    public function getCursus()
    {
        return $this->cursus;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return CursusRegistrations
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
