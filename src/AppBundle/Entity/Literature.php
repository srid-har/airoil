<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Literature
 *
 * @ORM\Table()
 * @ORM\Entity
 * 
 * @Vich\Uploadable
 */
class Literature
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
    //  * @ORM\Column(name="manufacturer_id", type="integer", length=11)
     
    // private $manufacturer_id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Manufacturer", inversedBy="literature")
     *
     * @var AppBundle\Entity\Manufacturer;
     */
    protected $manufacturer;

    /**
     * Set manufacturer
     *
     * @param \AppBundle\Entity\Manufacturer $manufacturer
     * @return literature
     */
    public function setManufacturer(\AppBundle\Entity\Manufacturer $manufacturer = null)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    /**
     * Get manufacturer
     *
     * @return \AppBundle\Entity\Manufacturer 
     */
    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    // *
    //  * @var int
    //  *
    //  * @ORM\Column(name="product_id", type="integer", length=11)
     
    // private $product_id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Product", inversedBy="literature1")
     *
     * @var AppBundle\Entity\Product;
     */
    protected $product;

    /**
     * Set product
     *
     * @param \AppBundle\Entity\Product $product
     * @return literature
     */
    public function setProduct(\AppBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \AppBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="img_url", type="string", length=255)
     */
    private $img_url;

    /**
     * @Vich\UploadableField(mapping="literature_image", fileNameProperty="img_url")
     * 
     * @var File $img_urlFile
     */
    protected $img_urlFile;

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setImgUrlFile(File $image = null)
    {
        $this->img_urlFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
        }
    }
    /**
     * @return File
     */
    public function getImgUrlFile()
    {
        return $this->img_urlFile;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @Vich\UploadableField(mapping="literature_file", fileNameProperty="filename")
     * 
     * @var File $filenameFile
     */
    protected $filenameFile;

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     */
    public function setFilenameFile(File $image = null)
    {
        $this->filenameFile = $image;

        if ($image) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTime('now');
            $this->filesize = "";
        }
    }
    /**
     * @return File
     */
    public function getFilenameFile()
    {
        return $this->filenameFile;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="filesize", type="string", length=255)
     */
    private $filesize;

    /**
     * @var string
     *
     * @ORM\Column(name="link_url", type="string", length=255)
     */
    private $link_url;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

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
     * Set manufacturer_id
     *
     * @param integer $manufacturerId
     * @return Literature
     */
    public function setManufacturerId($manufacturerId)
    {
        $this->manufacturer_id = $manufacturerId;

        return $this;
    }

    /**
     * Get manufacturer_id
     *
     * @return integer 
     */
    public function getManufacturerId()
    {
        return $this->manufacturer_id;
    }

    /**
     * Set product_id
     *
     * @param integer $productId
     * @return Literature
     */
    public function setProductId($productId)
    {
        $this->product_id = $productId;

        return $this;
    }

    /**
     * Get product_id
     *
     * @return integer 
     */
    public function getProductId()
    {
        return $this->product_id;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Literature
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set img_url
     *
     * @param string $imgUrl
     * @return Literature
     */
    public function setImgUrl($imgUrl)
    {
        $this->img_url = $imgUrl;

        return $this;
    }

    /**
     * Get img_url
     *
     * @return string 
     */
    public function getImgUrl()
    {
        return $this->img_url;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Literature
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
     * Set filename
     *
     * @param string $filename
     * @return Literature
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string 
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set filesize
     *
     * @param string $filesize
     * @return Literature
     */
    public function setFilesize($filesize)
    {
        $this->filesize = $filesize;

        return $this;
    }

    /**
     * Get filesize
     *
     * @return string 
     */
    public function getFilesize()
    {
        return $this->filesize;
    }

    /**
     * Set link_url
     *
     * @param string $linkUrl
     * @return Literature
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
     * Set description
     *
     * @param string $description
     * @return Literature
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
     * Set created_at
     *
     * @param string $created_at
     * @return Literature
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
     * @return Literature
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
