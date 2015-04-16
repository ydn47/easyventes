<?php

namespace Easy\Bundle\VentesBundle\Entity;

use Easy\Bundle\VentesBundle\Entity\Product;
use Easy\Bundle\VentesBundle\Entity\Event;
use Easy\Bundle\VentesBundle\Entity\ProductSaleRepository;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductSale
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="ProductSaleRepository")
 */
class ProductSale
{
    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="products")
     * @ORM\Id
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;
    
    /**
     * @ORM\ManyToOne(targetEntity="Event", inversedBy="events")
     * @ORM\Id
     * @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     */
    private $event;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="qty", type="integer")
     */
    private $qty;
  

    /**
     * Set qty
     *
     * @param integer $qty
     * @return ProductSale
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
     * Set product
     *
     * @param Product $product
     * @return ProductSale
     */
    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set event
     *
     * @param Event $event
     * @return ProductSale
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
