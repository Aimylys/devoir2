<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Location;
use App\Entity\Bijou;
use App\Entity\Client;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LocationFixtures extends Fixture implements DependentFixtureInterface
{
    private $faker;

	public function __construct()
	{
		$this -> faker = Factory::create("fr_FR");
	}

    public function load(ObjectManager $manager): void
    {
		for($i=0 ;$i<30 ;$i++){
			$location = new Location();
			$location -> setDateDebut($this -> faker -> dateTimeThisYear());
            $location -> setDateFin($this -> faker -> dateTimeThisYear());
            $location -> setClient($this -> getReference("client".mt_rand(0,29)));
            $location -> setBijou($this -> getReference("bijou".mt_rand(0,29))); 
			$manager ->persist($location);
		}
		$manager ->flush();
	}

	public function getDependencies()
	{
		return [ClientFixtures::class , 
                BijouFixtures::class];
	}
}

