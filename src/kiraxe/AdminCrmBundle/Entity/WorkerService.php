<?php

namespace kiraxe\AdminCrmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * WorkerService
 *
 * @ORM\Table(name="worker_service")
 * @ORM\Entity(repositoryClass="kiraxe\AdminCrmBundle\Repository\WorkerServiceRepository")
 */
class WorkerService
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
     * @var int
     *
     * @ORM\Column(name="service_id", type="integer")
     */
    /*private $serviceId;*/

    /**
     * @var int
     *
     * @ORM\Column(name="percent", type="integer")
     */
    private $percent;


    // ...
    /**
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="kiraxe\AdminCrmBundle\Entity\Workers", inversedBy="workerservice")
     * @ORM\JoinColumn(name="worker_id", referencedColumnName="id")
     */
    private $workers;


    /**
     * @ORM\ManyToOne(targetEntity="kiraxe\AdminCrmBundle\Entity\Services", fetch="EAGER", inversedBy="workerservice")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     */
    private $services;


    public function setServices(Services $service = null)
    {
        $this->services = $service;
    }

    public function getServices()
    {
        return $this->services;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /*/**
     * Set workerId
     *
     * @param integer $workerId
     *
     * @return WorkerService
     */
    /*public function setWorkerId($workerId)
    {
        $this->workerId = $workerId;

        return $this;
    }

    /**
     * Get workerId
     *
     * @return int
     */
    /*public function getWorkerId()
    {
        return $this->workerId;
    }*/

    /*/**
     * Set serviceId
     *
     * @param integer $serviceId
     *
     * @return WorkerService
     */
    /*public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;

        return $this;
    }

    /**
     * Get serviceId
     *
     * @return int
     */
    /*public function getServiceId()
    {
        return $this->serviceId;
    }*/

    /**
     * Set percent
     *
     * @param integer $percent
     *
     * @return WorkerService
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;

        return $this;
    }

    /**
     * Get percent
     *
     * @return int
     */
    public function getPercent()
    {
        return $this->percent;
    }

    public function setWorkers(Workers $worker = null)
    {
        $this->workers = $worker;
    }

    public function getWorkers()
    {
        return $this->workers;
    }
}

