<?php

namespace Easy\Bundle\VentesBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Easy\Bundle\VentesBundle\Entity\Category;
use Easy\Bundle\VentesBundle\Entity\ProductRepository;
use Easy\Bundle\VentesBundle\Entity\ProductSale;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;


/**
 * Product
 *
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="ProductRepository")
 */
class Product
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="qty", type="integer")
     */
    private $qty;
    
    /**
     * @ORM\ManyToMany(targetEntity="Category", cascade={"persist"})
     */
    private $categories;
    
    /**
     * @ORM\OneToMany(targetEntity="ProductSale", mappedBy="product", cascade={"persist"})
     */
    private $events;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @Assert\File(
     *     maxSize = "1024k",
     *     mimeTypes = {"image/jpg", "image/jpeg", "image/png", "image/gif"},
     *     mimeTypesMessage = "Choisissez un fichier image valide"
     * )
     */
    private $file;

    /**
     * @var string
     */
    private $tmpImage;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Product
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
     * Set description
     *
     * @param string $description
     * @return Product
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
     * Set picture
     *
     * @param string $picture
     * @return Product
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set qty
     *
     * @param integer $qty
     * @return Product
     */
    public function setQty($qty)
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * Get qty
     *
     * @return integer 
     */
    public function getQty()
    {
        return $this->qty;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Product
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }
    
    /**
     * Add categories
     * 
     * @param Category $categories
     * @return Product
     */
    public function addCategory(Category $categories)
    {
        $this->categories[] = $categories;
        
        return $this;
    }
    
    /**
     * Remove categories
     * 
     * @param Category $categories
     */
    public function removeCategory(Category $categories)
    {
        $this->categories->removeElement($categories);
    }
    
    /**
     * Get categories
     * 
     * @return Category
     */
    public function getCategories()
    {
        return $this->categories;
    }
    
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Add events
     *
     * @param ProductSale $events
     * @return Product
     */
    public function addEvent(ProductSale $events)
    {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param ProductSale $events
     */
    public function removeEvent(ProductSale $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;

        if (isset($this->picture)) {
            $this->tmpImage = $this->picture;
            $this->picture = null;
        } else {
            $this->picture = 'creation';
        }

        return $this;
    }


    public function getFile()
    {
        return $this->file;
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            $picture = sha1(uniqid('img_'));
            $this->setPicture($picture . '.' . $this->getFile()->guessExtension());
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        $this->getFile()->move($this->getUploadRootDir(), $this->getPicture());

        if (isset($this->tmpImage)) {
            unlink($this->getUploadDir().'/'.$this->tmpImage);
            $this->tmpImage = null;
        }
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if (($file = $this->getAbsolutePath())) {
            unlink($file);
        }
    }

    public function getAbsolutePath()
    {
        if (null === $this->getPicture()) {
            return;
        }
        return $this->getUploadRootDir() . '/' . $this->getPicture();
    }

    public function getWebPath()
    {
        if (null === $this->getPicture()) {
            return;
        }
        return $this->getUploadDir() . '/' . $this->getPicture();
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__ . '/../../../../web/' . $this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'upload/documents';
    }
}
