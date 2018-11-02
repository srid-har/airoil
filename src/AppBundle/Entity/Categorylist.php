<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Categorylist
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Categorylist
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
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Manufacturer", mappedBy="categorylist")
     */
    protected $manufacturer;

    public function __construct()
    {
        // parent::__construct();

        $this->manufacturer = new ArrayCollection();
        // your own logic
    }

    public function __toString() {
        return $this->categorylist;
    }
    
    /**
     * Add manufacturer
     *
     * @param \AppBundle\Entity\Manufacturer $manufacturer
     * @return Categorylist
     */
    public function addManufacturer(\AppBundle\Entity\Manufacturer $manufacturer)
    {
        $this->manufacturer[] = $manufacturer;

        return $this;
    }

     /**
     * Remove manufacturer
     *
     * @param \AppBundle\Entity\Manufacturer $manufacturer
     */
    public function removeManufacturer(\AppBundle\Entity\Manufacturer $manufacturer)
    {
        $this->manufacturer->removeElement($manufacturer);
    }

    /**
     * Get manufacturer
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="categorylist", type="string", length=255)
     */
    private $categorylist;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", length=11)
     */
    private $status;

    /**
     * @var \DateTime
     * 
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;
    
    /**
     * @var \DateTime
     * 
     * @Gedmo\Timestampable(on="create")
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;


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
     * Set categorylist
     *
     * @param string $categorylist
     * @return Categorylist
     */
    public function setCategorylist($categorylist)
    {
        $this->categorylist = $categorylist;

        return $this;
    }

    /**
     * Get categorylist
     *
     * @return string 
     */
    public function getCategorylist()
    {
        return $this->categorylist;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Categorylist
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set created_at
     *
     * @param string $created_at
     * @return Categorylist
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return string 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Categorylist
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
}
