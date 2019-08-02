<?php

namespace kiraxe\AdminCrmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ManagerOrders
 *
 * @ORM\Table(name="manager_orders")
 * @ORM\Entity(repositoryClass="kiraxe\AdminCrmBundle\Repository\ManagerOrdersRepository")
 */
class ManagerOrders
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
     * @var float
     *
     * @ORM\Column(name="openprice", type="float", nullable=true)
     */
    private $openprice;

    /**
     * @var float
     *
     * @ORM\Column(name="closeprice", type="float", nullable=true)
     */
    private $closeprice;


    /**
     * @ORM\ManyToOne(targetEntity="kiraxe\AdminCrmBundle\Entity\Orders", inversedBy="managerorders")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $orders;


    /**
     * @ORM\ManyToOne(targetEntity="kiraxe\AdminCrmBundle\Entity\Workers")
     */
    private $worker;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set closeprice
     *
     * @param float $closeprice
     *
     * @return ManagerOrders
     */
    public function setCloseprice($closeprice)
    {
        $this->closeprice = $closeprice;

        return $this;
    }

    /**
     * Get closeprice
     *
     * @return float
     */
    public function getCloseprice()
    {
        return $this->closeprice;
    }

    /**
     * Set openprice
     *
     * @param float $openprice
     *
     * @return ManagerOrders
     */
    public function setOpenprice($openprice)
    {
        $this->openprice = $openprice;

        return $this;
    }

    /**
     * Get openprice
     *
     * @return float
     */
    public function getOpenprice()
    {
        return $this->openprice;
    }

    public function getOrders()
    {
        return $this->orders;
    }

    public function setOrders($orders)
    {
        $this->orders = $orders;

        return $this;
    }


    public function getWorkers()
    {
        return $this->worker;
    }

    public function setWorkers($worker)
    {
        $this->worker = $worker;

        return $this;
    }
}

