<?php

namespace Easy\Bundle\VentesBundle\Entity;

use Easy\Bundle\VentesBundle\Entity\Event;
use Easy\Bundle\VentesBundle\Entity\User;
use Easy\Bundle\VentesBundle\Entity\UserEventRepository;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserEvent
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="UserEventRepository")
 */
class UserEvent
{
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="users")
     * @ORM\Id
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="events")
     * @ORM\Id
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $event;
    
    /**
     * @var DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", columnDefinition="enum('DEM', 'VAL', 'REF')")
     */
    private $state;

    /**
     * Set date
     *
     * @param DateTime $date
     * @return UserEvent
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return UserEvent
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set user
     *
     * @param User $user
     * @return UserEvent
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set event
     *
     * @param Event $event
     * @return UserEvent
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;

        return $this;
    }

    /**
     * Get event
     *
     * @return Event 
     */
    public function getEvent()
    {
        return $this->event;
    }
}
