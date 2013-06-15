<?php

namespace Userstories\CoreBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
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
     * @ORM\OneToMany(targetEntity="Story",mappedBy="user")
     */
    protected $stories;

    /**
     * @ORM\OneToMany(targetEntity="Estimate",mappedBy="user")
     */
    protected $estimates;

    public function __construct()
    {
        parent::__construct();
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

    /**
     * Add stories
     *
     * @param \Userstories\CoreBundle\Entity\Story $stories
     * @return User
     */
    public function addStorie(\Userstories\CoreBundle\Entity\Story $stories)
    {
        $this->stories[] = $stories;

        return $this;
    }

    /**
     * Remove stories
     *
     * @param \Userstories\CoreBundle\Entity\Story $stories
     */
    public function removeStorie(\Userstories\CoreBundle\Entity\Story $stories)
    {
        $this->stories->removeElement($stories);
    }

    /**
     * Get stories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStories()
    {
        return $this->stories;
    }

    /**
     * Add estimates
     *
     * @param \Userstories\CoreBundle\Entity\Estimate $estimates
     * @return User
     */
    public function addEstimate(\Userstories\CoreBundle\Entity\Estimate $estimates)
    {
        $this->estimates[] = $estimates;
    
        return $this;
    }

    /**
     * Remove estimates
     *
     * @param \Userstories\CoreBundle\Entity\Estimate $estimates
     */
    public function removeEstimate(\Userstories\CoreBundle\Entity\Estimate $estimates)
    {
        $this->estimates->removeElement($estimates);
    }

    /**
     * Get estimates
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstimates()
    {
        return $this->estimates;
    }
}