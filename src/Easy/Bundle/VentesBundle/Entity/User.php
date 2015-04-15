<?php

namespace Easy\Bundle\VentesBundle\Entity;




use Doctrine\Common\Collections\Collection;
use Easy\Bundle\VentesBundle\Entity\User;
use Easy\Bundle\VentesBundle\Entity\UserEvent;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;


/**
 * User
 *
 * @ORM\Table(name="User")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="userlastname", type="string", length=255)
     */
    private $userlastname;
    
    /**
     * @var string
     *
     * @ORM\Column(name="userfirstname", type="string", length=255)
     */
    private $userfirstname;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="newsletter", type="boolean")
     */
    private $newsletter;
    
    /**
     * @ORM\OneToMany(targetEntity="UserEvent", mappedBy="user", cascade={"persist"})
     */
    private $events;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function getUserlastname()
    {
        return $this->userlastname;
    }
    
    public function getUserFirstName()
    {
        return $this->userfirstname;
    }

    public function getNewsletter()
    {
        return $this->newsletter;
    }

    public function setUserlastname($userlastname)
    {
        $this->userlastname = $userlastname;
        return $this;
    }
    
    public function setUserFirstName($userfirstname)
    {
        $this->userfirstname = $userfirstname;
        return $this;
    }    

    public function setNewsletter($newsletter)
    {
        $this->newsletter = $newsletter;
        return $this;
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
     * Add events
     *
     * @param UserEvent $events
     * @return User
     */
    public function addEvent(UserEvent $events)
    {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param UserEvent $events
     */
    public function removeEvent(UserEvent $events)
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
}
