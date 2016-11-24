<?php
/**
 * Created by PhpStorm.
 * User: ylamb
 * Date: 14-10-2016
 * Time: 17:30
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="UserProfile", mappedBy="user")
     */
    private $item;

    public function __construct()
    {
        parent::__construct();
        $this->item = new ArrayCollection();

    }

    /**
     * Add item
     *
     * @param \AppBundle\Entity\UserProfile $item
     *
     * @return User
     */
    public function addItem(\AppBundle\Entity\UserProfile $item)
    {
        $this->item[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \AppBundle\Entity\UserProfile $item
     */
    public function removeItem(\AppBundle\Entity\UserProfile $item)
    {
        $this->item->removeElement($item);
    }

    /**
     * Get item
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getItem()
    {
        return $this->item;
    }
}
