<?php

namespace Userstories\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Story
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Userstories\CoreBundle\Entity\StoryRepository")
 */
class Story
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
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\ManyToOne(targetEntity="User",inversedBy="stories")
     */
    protected $user;

    /**
     * @ORM\OneToMany(targetEntity="Estimate",mappedBy="story")
     */
    protected $estimates;

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
     * Set description
     *
     * @param string $description
     * @return Story
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set user
     *
     * @param \Userstories\CoreBundle\Entity\User $user
     * @return Story
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
     * Constructor
     */
    public function __construct()
    {
        $this->estimates = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add estimates
     *
     * @param \Userstories\CoreBundle\Entity\Estimate $estimates
     * @return Story
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