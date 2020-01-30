<?php

namespace kiraxe\AdminCrmBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Services
 *
 * @ORM\Table(name="services")
 * @ORM\Entity(repositoryClass="kiraxe\AdminCrmBundle\Repository\ServicesRepository")
 */
class Services
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
     * @ORM\OneToMany(targetEntity="kiraxe\AdminCrmBundle\Entity\WorkerService", fetch="EAGER", mappedBy="services", cascade={"persist"})
     */
    private $workerservice;

    /**
     * @ORM\OneToMany(targetEntity="kiraxe\AdminCrmBundle\Entity\WorkerOrders", fetch="EAGER", mappedBy="services", cascade={"persist"})
     */
    private $workerorders;

    /**
     * @ORM\OneToMany(targetEntity="kiraxe\AdminCrmBundle\Entity\Services", fetch="EAGER", mappedBy="parent", cascade={"persist"})
     */
    private $childrens;

    /**
     * @ORM\ManyToOne(targetEntity="kiraxe\AdminCrmBundle\Entity\Services", fetch="EAGER", inversedBy="childrens")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;


    /**
     * @var bool
     *
     * @ORM\Column(name="free", type="boolean")
     */
    private $free;

    /**
     * @var bool
     *
     * @ORM\Column(name="pricefr", type="boolean")
     */
    private $pricefr;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", options={"default":1})
     */
    private $active;


    public function __construct()
    {
        $this->workerservice = new ArrayCollection();
        $this->childrens = new ArrayCollection();
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
     * @return Services
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

    public function getWorkerService()
    {
        return $this->workerservice;
    }
    public function addWorkerservouse(WorkerService $workerservices)
    {
        $workerservices->setServices($this);
        $this->workerservice->add($workerservices);
    }

    public function removeWorkerservouse(WorkerService $workerservices)
    {
        $this->workerservice->removeElement($workerservices);
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent(Services $parent = null)
    {
        $this->parent = $parent;
    }

    public function addChildrens(Services $childrens)
    {
        $childrens->setParent($this);
        $this->childrens->add($childrens);
    }

    public function removeChildrens(Services $childrens)
    {
        $this->childrens->removeElement($childrens);
    }

    public function getChildrens()
    {
        return $this->childrens;
    }


    public function getWorkerOrders()
    {
        return $this->workerorders;
    }
    public function addWorkerOrders(WorkerOrders $workerorders)
    {
        $workerorders->setServices($this);
        $this->workerorders->add($workerorders);
    }

    public function removeWorkerOrders(WorkerOrders $workerorders)
    {
        $this->workerorders->removeElement($workerorders);
    }


    /**
     * Set free
     *
     * @param boolean $free
     *
     * @return Services
     */
    public function setFree($free)
    {
        $this->free = $free;

        return $this;
    }

    /**
     * Get free
     *
     * @return bool
     */
    public function getFree()
    {
        return $this->free;
    }



    /**
     * Set pricefr
     *
     * @param boolean $pricefr
     *
     * @return Services
     */
    public function setPricefr($pricefr)
    {
        $this->pricefr = $pricefr;

        return $this;
    }

    /**
     * Get free
     *
     * @return bool
     */
    public function getpricefr()
    {
        return $this->pricefr;
    }


    /**
     * Get active
     *
     * @return int
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set active
     *
     * @param string $active
     *
     * @return Services
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }


}

