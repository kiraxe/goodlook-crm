<?php

namespace kiraxe\AdminCrmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ManagerPercent
 *
 * @ORM\Table(name="manager_percent")
 * @ORM\Entity(repositoryClass="kiraxe\AdminCrmBundle\Repository\ManagerPercentRepository")
 */
class ManagerPercent
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
     * @ORM\Column(name="openpercent", type="float", nullable=true)
     */
    private $openpercent;

    /**
     * @var float
     *
     * @ORM\Column(name="closepercent", type="float", nullable=true)
     */
    private $closepercent;


    /**
     * Many features have one product. This is the owning side.
     * @ORM\ManyToOne(targetEntity="kiraxe\AdminCrmBundle\Entity\Workers", inversedBy="managerpercent")
     * @ORM\JoinColumn(name="worker_id", referencedColumnName="id")
     */
    private $workers;


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
     * Set openpercent
     *
     * @param float $openpercent
     *
     * @return ManagerPercent
     */
    public function setOpenpercent($openpercent)
    {
        $this->openpercent = $openpercent;

        return $this;
    }

    /**
     * Get openpercent
     *
     * @return float
     */
    public function getOpenpercent()
    {
        return $this->openpercent;
    }

    /**
     * Set closepercent
     *
     * @param float $closepercent
     *
     * @return ManagerPercent
     */
    public function setClosepercent($closepercent)
    {
        $this->closepercent = $closepercent;

        return $this;
    }

    /**
     * Get closepercent
     *
     * @return float
     */
    public function getClosepercent()
    {
        return $this->closepercent;
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

