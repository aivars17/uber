<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DriverRepository")
 */
class Driver
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Please enter the name")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $license;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Car", inversedBy="drivers")
     * @ORM\JoinTable(name="car_driver")
     */
    private $cars;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trip", mappedBy="driver")
     */
    private $driver;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Please, upload your photo")
     */
    private $photo;


    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLicense()
    {
        return $this->license;
    }

    /**
     * @param mixed $license
     */
    public function setLicense($license): void
    {
        $this->license = $license;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age): void
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getCars()
    {
        return $this->cars;
    }

    public function addCar(Car $car)
    {
        if(!$this->cars->contains($car))
        {
            $this->cars[] = $car;
            $car->addDriver($this);
        }

        return $this;
    }

    public function removeCar(Car $car)
    {
        if(!$this->cars->contains($this))
        {
           return;
        }
        $this->cars->removeElement($car);
        $car->removeDriver($this);
    }

    /**
     * @return mixed
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * @param mixed $driver
     */
    public function setDriver($driver): void
    {
        $this->driver = $driver;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo): void
    {
        $this->photo = $photo;

    }
}
