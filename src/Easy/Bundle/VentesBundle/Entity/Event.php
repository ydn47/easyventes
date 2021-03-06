<?php

namespace Easy\Bundle\VentesBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="EventRepository")
 */
class Event
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
     * @var DateTime
     *
     * @ORM\Column(name="dateStart", type="datetime")
     */
    private $dateStart;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="dateEnd", type="datetime")
     */
    private $dateEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity="Category", cascade={"persist"})
     */
    private $categories;
    
    /**
     * @ORM\OneToMany(targetEntity="UserEvent", mappedBy="event", cascade={"persist"})
     */
    private $users;
    
    /**
     * @ORM\OneToMany(targetEntity="ProductSale", mappedBy="event", cascade={"persist"})
     */
    private $products;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbpers", type="integer")
     */
    private $nbpers;

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
     * @return Event
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
     * Set dateStart
     *
     * @param DateTime $dateStart
     * @return Event
     */
    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    /**
     * Get dateStart
     *
     * @return DateTime 
     */
    public function getDateStart()
    {
        return $this->dateStart;
    }

    /**
     * Set dateEnd
     *
     * @param DateTime $dateEnd
     * @return Event
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return DateTime 
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Event
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
     * Add categories
     * 
     * @param Category $categories
     * @return Event
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
     * @return Collection
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
     * Add users
     *
     * @param UserEvent $users
     * @return Event
     */
    public function addUser(UserEvent $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param UserEvent $users
     */
    public function removeUser(UserEvent $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add products
     *
     * @param ProductSale $products
     * @return Event
     */
    public function addProduct(ProductSale $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param ProductSale $products
     */
    public function removeProduct(ProductSale $products)
    {
        $this->products->removeElement($products);
    }

    /**
     * Get products
     *
     * @return Collection 
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Set nbpers
     *
     * @param integer $nbpers
     * @return Event
     */
    public function setNbPers($nbpers)
    {
        $this->nbpers = $nbpers;

        return $this;
    }

    /**
     * Get nbpers
     *
     * @return integer
     */
    public function getNbPers()
    {
        return $this->nbpers;
    }

    /**
     * @Assert\Callback
     */
    public function isDateValid(ExecutionContextInterface $context){
        if($this->getDateStart() > $this->getDateEnd()){
            $context
                ->buildViolation('La date de début doit être antérieur à la date de fin')
                ->atPath('dateStart')
                ->addViolation()
            ;
        }
        if($this->getDateStart() < new DateTime()){
            $context
                ->buildViolation('Vous devez créer un évènement avant que celui ci ne commence')
                ->atPath('dateStart')
                ->addViolation()
            ;
        }
    }
}
