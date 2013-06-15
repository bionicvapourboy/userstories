<?php

namespace Userstories\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estimate
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Estimate
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="estimatedtime", type="integer")
     */
    protected $estimatedtime;

    /**
     * @ORM\ManyToOne(targetEntity="User",inversedBy="estimates")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Story",inversedBy="estimates")
     */
    protected $story;

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
     * Set estimatedtime
     *
     * @param integer $estimatedtime
     * @return Estimate
     */
    public function setEstimatedtime($estimatedtime)
    {
        $this->estimatedtime = $estimatedtime;

        return $this;
    }

    /**
     * Get estimatedtime
     *
     * @return integer
     */
    public function getEstimatedtime()
    {
        return $this->estimatedtime;
    }

    /**
     * Set user
     *
     * @param \Userstories\CoreBundle\Entity\User $user
     * @return Estimate
     */
    public function setUser(\Userstories\CoreBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Userstories\CoreBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set story
     *
     * @param \Userstories\CoreBundle\Entity\Story $story
     * @return Estimate
     */
    public function setStory(\Userstories\CoreBundle\Entity\Story $story = null)
    {
        $this->story = $story;
    
        return $this;
    }

    /**
     * Get story
     *
     * @return \Userstories\CoreBundle\Entity\Story 
     */
    public function getStory()
    {
        return $this->story;
    }
}