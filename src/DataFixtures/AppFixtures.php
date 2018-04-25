<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\Clients;
use App\Entity\Driver;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker\Factory;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;
    /**
     * @var Factory
     */
    private $faker;

    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager )
    {
        $faker = Factory::create();
        $faker->addProvider(new \carfaker\provider\Car($faker));
        for ($i=0;$i <10;$i++)
        {

            $user = new User();
            $user->setUsername($faker->name);
            $password = $this->passwordEncoder->encodePassword($user, 'admin');
            $user->setPassword($password);
            if ($i % 10){
                $user->setRoles(['ROLE_ADMIN']);
            }else {
                $user->setRoles(['ROLE_USER']);
            }
            $manager->persist($user);
            $manager->flush();

//            $client = new Clients();
//            $client->setName($faker->name);
//            $client->setGender('male');
//            $manager->persist($client);
//            $manager->flush();
//
//            $car = new Car();
//            $split = explode(' ', $faker->car);
//            $car->setMake($split[0]);
//            $car->setModel($split[1]);
//            $car->setType(1);
//            $manager->persist($car);
//            $manager->flush();
//
//            $driver = new Driver();
//            $driver->setName($faker->name);
//            $driver->setLicense($faker->ean8);
//            $driver->setAge(rand(18,50));
//            $manager->persist($driver);
//            $manager->flush();
        }

    }
}
