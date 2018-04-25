<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CarRepository")
 */
class Car
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $make;

    /**
     * @ORM\Column(type="string")
     */
    private $model;

    /**
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Driver", mappedBy="cars")
     */
    private $drivers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trip", mappedBy="cars")
     */
    private $trip;

    public function __construct()
    {
        $this->drivers = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getMake()
    {
        return $this->make;
    }

    /**
     * @param mixed $make
     */
    public function setMake($make): void
    {
        $this->make = $make;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getDriver()
    {
        return $this->drivers;
    }

    public function addDriver(Driver $driver)
    {
        if(!$this->drivers->contains($driver))
        {
            $this->drivers[] = $driver;
            $driver->addCar($this);
        }
        return $this;
    }

    public function removeDriver(Driver $driver)
    {
        if(!$this->drivers->contains($driver)){
            return;
        }
        $this->driver->removeElement($driver);
        $driver->removeCar($this);
    }

    /**
     * @return mixed
     */
    public function getTrip()
    {
        return $this->trip;
    }

    /**
     * @param mixed $trip
     */
    public function setTrip($trip): void
    {
        $this->trip = $trip;
    }

    /**
     * @return mixed
     */
    public function getTrips()
    {
        return $this->trips;
    }

    /**
     * @param mixed $trips
     */
    public function setTrips($trips): void
    {
        $this->trips = $trips;
    }

    /**
     * @return mixed
     */
    public function getDrivers()
    {
        return $this->drivers;
    }

    /**
     * @param mixed $drivers
     */
    public function setDrivers($drivers): void
    {
        $this->drivers = $drivers;
    }
}
