<?php

namespace Easy\Bundle\VentesBundle\Entity;


use Easy\Bundle\VentesBundle\Entity\Category;
use Easy\Bundle\VentesBundle\Entity\User;
use Easy\Bundle\VentesBundle\Entity\UserCategoryRepository;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserEvent
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="UserCategoryRepository")
 */
class UserCategory
{
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="users")
     * @ORM\Id
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="categories")
     * @ORM\Id
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;
    
    /**
     * Set active
     *
     * @param boolean $active
     * @return UserCategory
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
     * Set user
     *
     * @param User $user
     * @return UserCategory
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
     * Set category
     *
     * @param Category $category
     * @return UserCategory
     */
    public function setCategory(Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
