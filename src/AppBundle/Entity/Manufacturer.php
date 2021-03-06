<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Manufacturer
 *
 * @ORM\Table()
 * @ORM\Entity
 * 
 * @Vich\Uploadable
 */
class Manufacturer
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    // *
    //  * @var int
    //  *
    //  * @ORM\Column(name="categorylist_id", type="integer", length=11)
     
    // private $categorylist_id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Categorylist", inversedBy="manufacturer")
     *
     * @var AppBundle\Entity\Categorylist;
     */
    protected $categorylist;

    /**
     * Set categorylist
     *
     * @param \AppBundle\Entity\Categorylist $categorylist
     * @return manufacturer
     */
    public function setCategorylist(\AppBundle\Entity\Categorylist $categorylist = null)
    {
        $this->categorylist = $categorylist;

        return $this;
    }

    /**
     * Get categorylist
     *
     * @return \AppBundle\Entity\Categorylist 
     */
    public function getCategorylist()
    {
        return $this->categorylist;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="small_logo_url", type="string", length=255)
     */
    private $small_logo_url;

    /**
     * @Vich\UploadableField(mapping="manufacturer_small_image", fileNameProperty="small_logo_url")
     * 
     * @var File $small_logo_urlFile
     */
    protected $small_logo_urlFile;

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setSmallLogoUrlFile(File $image = null)
    {
        $this->small_logo_urlFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }
    /**
     * @return File
     */
    public function getSmallLogoUrlFile()
    {
        return $this->small_logo_urlFile;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="logo_url", type="string", length=255)
     */
    private $logo_url;

    /**
     * @Vich\UploadableField(mapping="manufacturer_image", fileNameProperty="logo_url")
     * 
     * @var File $logo_urlFile
     */
    protected $logo_urlFile;

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setLogoUrlFile(File $image = null)
    {
        $this->logo_urlFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }
    /**
     * @return File
     */
    public function getLogoUrlFile()
    {
        return $this->logo_urlFile;
    }
    
    /**
     * @var string
     *
     * @ORM\Column(name="manufacturer_name", type="string", length=255)
     */
    private $manufacturer_name;

////////////
    /**
     * @var ArrayCollection
     * 
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Product", mappedBy="manufacturer_name")
     */
    protected $product;

    public function __construct()
    {
        // parent::__construct();

        $this->product = new ArrayCollection();
        // your own logic
    }

    public function __toString() {
        return $this->manufacturer_name;
    }
    
    /**
     * Add product
     *
     * @param \AppBundle\Entity\Product $product
     * @return Manufacturer
     */
    public function addProduct(\AppBundle\Entity\Product $product)
    {
        $this->product[] = $product;

        return $this;
    }

     /**
     * Remove product
     *
     * @param \AppBundle\Entity\Product $product
     */
    public function removeProduct(\AppBundle\Entity\Product $product)
    {
        $this->product->removeElement($product);
    }

    /**
     * Get product
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getProduct()
    {
        return $this->product;
    }
///////////
    /**
     * @var string
     *
     * @ORM\Column(name="short", type="string", length=255)
     */
    private $short;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="store_url", type="string", length=255)
     */
    private $store_url;

    /**
     * @var string
     *
     * @ORM\Column(name="link_url", type="string", length=255)
     */
    private $link_url;

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
     * Set categorylist_id
     *
     * @param integer $categorylistId
     * @return Manufacturer
     */
    public function setCategorylistId($categorylistId)
    {
        $this->categorylist_id = $categorylistId;

        return $this;
    }

    /**
     * Get categorylist_id
     *
     * @return integer 
     */
    public function getCategorylistId()
    {
        return $this->categorylist_id;
    }

    /**
     * Set small_logo_url
     *
     * @param string $smallLogoUrl
     * @return Manufacturer
     */
    public function setSmallLogoUrl($smallLogoUrl)
    {
        $this->small_logo_url = $smallLogoUrl;

        return $this;
    }

    /**
     * Get small_logo_url
     *
     * @return string 
     */
    public function getSmallLogoUrl()
    {
        return $this->small_logo_url;
    }

    /**
     * Set logo_url
     *
     * @param string $logoUrl
     * @return Manufacturer
     */
    public function setLogoUrl($logoUrl)
    {
        $this->logo_url = $logoUrl;

        return $this;
    }

    /**
     * Get logo_url
     *
     * @return string 
     */
    public function getLogoUrl()
    {
        return $this->logo_url;
    }

    /**
     * Set manufacturer_name
     *
     * @param string $manufacturerName
     * @return Manufacturer
     */
    public function setManufacturerName($manufacturerName)
    {
        $this->manufacturer_name = $manufacturerName;

        return $this;
    }

    /**
     * Get manufacturer_name
     *
     * @return string 
     */
    public function getManufacturerName()
    {
        return $this->manufacturer_name;
    }

    /**
     * Set short
     *
     * @param string $short
     * @return Manufacturer
     */
    public function setShort($short)
    {
        $this->short = $short;

        return $this;
    }

    /**
     * Get short
     *
     * @return string 
     */
    public function getShort()
    {
        return $this->short;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Manufacturer
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
     * Set store_url
     *
     * @param string $storeUrl
     * @return Manufacturer
     */
    public function setStoreUrl($storeUrl)
    {
        $this->store_url = $storeUrl;

        return $this;
    }

    /**
     * Get store_url
     *
     * @return string 
     */
    public function getStoreUrl()
    {
        return $this->store_url;
    }

    /**
     * Set link_url
     *
     * @param string $linkUrl
     * @return Manufacturer
     */
    public function setLinkUrl($linkUrl)
    {
        $this->link_url = $linkUrl;

        return $this;
    }

    /**
     * Get link_url
     *
     * @return string 
     */
    public function getLinkUrl()
    {
        return $this->link_url;
    }

    /**
     * Set created_at
     *
     * @param string $created_at
     * @return Manufacturer
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
     * @return Manufacturer
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
