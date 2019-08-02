<?php

namespace kiraxe\AdminCrmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WorkerOrders
 *
 * @ORM\Table(name="worker_orders")
 * @ORM\Entity(repositoryClass="kiraxe\AdminCrmBundle\Repository\WorkerOrdersRepository")
 */
class WorkerOrders
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
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="kiraxe\AdminCrmBundle\Entity\Workers", fetch="EAGER", inversedBy="workerorders")
     * @ORM\JoinColumn(name="worker_id", referencedColumnName="id")
     */
    private $workers;

    /**
     * @ORM\ManyToOne(targetEntity="kiraxe\AdminCrmBundle\Entity\Orders", fetch="EAGER", inversedBy="workerorders")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $orders;

    /**
     * @ORM\ManyToOne(targetEntity="kiraxe\AdminCrmBundle\Entity\Services", fetch="EAGER", inversedBy="workerorders")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     */
    private $services;

    /**
     * @ORM\ManyToOne(targetEntity="kiraxe\AdminCrmBundle\Entity\Services", fetch="EAGER")
     * @ORM\JoinColumn(name="serviceparent_id", referencedColumnName="id")
     */
    private $serviceparent;

    /**
     * @ORM\ManyToOne(targetEntity="kiraxe\AdminCrmBundle\Entity\Materials", fetch="EAGER", inversedBy="workerorders")
     * @ORM\JoinColumn(name="material_id", referencedColumnName="id")
     */
    private $materials;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_of_material", type="float")
     */
    private $amountOfMaterial;


    /**
     * @var float
     *
     * @ORM\Column(name="marriage", type="float", options={"default":"0"})
     */
    private $marriage;


    /**
     * @var float
     *
     * @ORM\Column(name="fine", type="float", options={"default":"0"})
     */
    private $fine;

    /**
     * @var float
     *
     * @ORM\Column(name="salary", type="float")
     */
    private $salary;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function setWorkers(Workers $worker = null)
    {
        $this->workers = $worker;
    }

    public function getWorkers()
    {
        return $this->workers;
    }

    public function setOrders(Orders $order = null)
    {
        $this->orders = $order;
    }

    public function getOrders()
    {
        return $this->orders;
    }

    public function setServices(Services $service = null)
    {
        $this->services = $service;
    }

    public function getServices()
    {
        return $this->services;
    }


    public function setServicesparent(Services $serviceparent = null)
    {
        $this->serviceparent = $serviceparent;

        return $this;
    }

    public function getServicesparent()
    {
        return $this->serviceparent;
    }

    public function setMaterials(Materials $material = null)
    {
        $this->materials = $material;

        return $this;
    }

    public function getMaterials()
    {
        return $this->materials;
    }

    /**
     * Set amountOfMaterial
     *
     * @param float $amountOfMaterial
     *
     * @return WorkerOrders
     */
    public function setAmountOfMaterial($amountOfMaterial)
    {
        $this->amountOfMaterial = $amountOfMaterial;

        return $this;
    }

    /**
     * Get amountOfMaterial
     *
     * @return float
     */
    public function getAmountOfMaterial()
    {
        return $this->amountOfMaterial;
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return WorkerOrders
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


    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getSalary()
    {
        return $this->salary;
    }


    public function setMarriage($marriage)
    {
        $this->marriage = $marriage;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getMarriage()
    {
        return $this->marriage;
    }


    public function setFine($fine)
    {
        $this->fine = $fine;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getFine()
    {
        return $this->fine;
    }
}

