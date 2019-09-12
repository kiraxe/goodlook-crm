<?php

namespace kiraxe\AdminCrmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Materials
 *
 * @ORM\Table(name="materials")
 * @ORM\Entity(repositoryClass="kiraxe\AdminCrmBundle\Repository\MaterialsRepository")
 */
class Materials
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var float
     *
     * @ORM\Column(name="priceUnit", type="float", nullable=true)
     */
    private $priceUnit;


    /**
     * @var float
     *
     * @ORM\Column(name="pricepackage", type="float")
     */
    private $pricepackage;



    /**
     * @var float
     *
     * @ORM\Column(name="quantitypack", type="float")
     */
    private  $quantitypack;

    /**
     * @ORM\ManyToOne(targetEntity="kiraxe\AdminCrmBundle\Entity\Measure")
     */
    private $measure;

    /**
     * @var int
     *
     * @ORM\Column(name="rating", type="integer", nullable=true)
     */
    private $rating;


    /**
     * @ORM\ManyToOne(targetEntity="kiraxe\AdminCrmBundle\Entity\Services")
     */
    private $service;

    /**
     * @var float
     * @ORM\Column(name="totalsize", type="float", nullable=true)
     */
    private $totalsize;


    /**
     * @var float
     * @ORM\Column(name="residue", type="float", nullable=true)
     */
    private $residue;

    /**
     * @ORM\OneToMany(targetEntity="kiraxe\AdminCrmBundle\Entity\WorkerOrders", mappedBy="materials", cascade={"persist"})
     */
    private $workerorders;


    public function __construct()
    {
        $this->services = new ArrayCollection();
        $this->workerorders = new ArrayCollection();
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Materials
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
     * Set price
     *
     * @param float $price
     *
     * @return Materials
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }


    /**
     * Set priceUnit
     *
     * @param float $priceUnit
     *
     * @return Materials
     */
    public function setPriceUnit($priceUnit)
    {
        $this->priceUnit = $priceUnit;

        return $this;
    }

    /**
     * Get priceUnit
     *
     * @return float
     */
    public function getPriceUnit()
    {
        return $this->priceUnit;
    }



    /**
     * Set pricepackage
     *
     * @param float $pricepackage
     *
     * @return Materials
     */
    public function setPricepackage($pricepackage)
    {
        $this->pricepackage = $pricepackage;

        return $this;
    }

    /**
     * Get pricepackage
     *
     * @return float
     */
    public function getPricepackage()
    {
        return $this->pricepackage;
    }

    /**
     * Set quantitypack
     *
     * @param float $quantitypack
     *
     * @return Materials
     */
    public function setQuantitypack($quantitypack)
    {
        $this->quantitypack = $quantitypack;

        return $this;
    }

    /**
     * Get pricepackage
     *
     * @return float
     */
    public function getQuantitypack()
    {
        return $this->quantitypack;
    }

    /**
     * Set measureId
     *
     * @param integer $measureId
     *
     * @return Materials
     */
    public function setMeasureId($measure)
    {
        $this->measure = $measure;

        return $this;
    }

    /**
     * Get measureId
     *
     * @return int
     */
    public function getMeasureId()
    {
        return $this->measure;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Materials
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return int
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @return mixed
     */
    public function getServiceId()
    {
        return $this->service;
    }

    /**
     * @param mixed $serviceid
     */
    public function setServiceId($service)
    {
        $this->service = $service;
    }

    /**
     * Set totalsize
     *
     * @param float $totalsize
     *
     * @return Materials
     */
    public function setTotalsize($totalsize)
    {
        $this->totalsize = $totalsize;

        return $this;
    }

    /**
     * Get totalsize
     *
     * @return float
     */
    public function getTotalsize()
    {
        return $this->totalsize;
    }

    public function getWorkerOrders()
    {
        return $this->workerorders;
    }
    public function addWorkerOrders(WorkerOrders $workerorders)
    {
        $workerorders->setMaterials($this);
        $this->workerorders->add($workerorders);
    }

    public function removeWorkerOrders(WorkerOrders $workerorders)
    {
        $this->workerorders->removeElement($workerorders);
    }

    /**
     * Set residue
     *
     * @param float $residue
     *
     * @return Materials
     */
    public function setResidue($residue)
    {
        $this->residue = $residue;

        return $this;
    }

    /**
     * Get residue
     *
     * @return float
     */
    public function getResidue()
    {
        return $this->residue;
    }

}

