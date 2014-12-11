<?php

namespace Iboved\AdvertBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="advert")
 * @ORM\Entity
 */
class Advert
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="title", type="string", length=100)
     */
    private $title;

    /**
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Rubric", inversedBy="adverts", cascade={"persist"})
     * @ORM\JoinColumn(name="rubric_id", referencedColumnName="id")
     */
    private $rubric;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="adverts", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

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
     * Set title
     *
     * @param string $title
     * @return Advert
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
     * Set description
     *
     * @param string $description
     * @return Advert
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Advert
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
     * Set rubric
     *
     * @param \Iboved\AdvertBundle\Entity\Rubric $rubric
     * @return Advert
     */
    public function setRubric(\Iboved\AdvertBundle\Entity\Rubric $rubric = null)
    {
        $this->rubric = $rubric;

        return $this;
    }

    /**
     * Get rubric
     *
     * @return \Iboved\AdvertBundle\Entity\Rubric
     */
    public function getRubric()
    {
        return $this->rubric;
    }

    /**
     * Set user
     *
     * @param \Iboved\AdvertBundle\Entity\User $user
     * @return Advert
     */
    public function setUser(\Iboved\AdvertBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Iboved\AdvertBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
