<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Client;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ClientFixtures extends Fixture
{
    private $faker;

	public function __construct()
	{
		$this -> faker = Factory::create("fr_FR");
	}

    public function load(ObjectManager $manager): void
    {
		for($i=0 ;$i<30 ;$i++){
			$client = new Client();
			$client -> setNom($this -> faker -> lastName()); 
            $client -> setPrenom($this -> faker -> firstName());
            $client -> setAdresseRue($this -> faker -> address());
			$client -> setCodePostal($this -> faker -> numberBetween(28000, 78000));
            $client -> setVille($this -> faker -> city());
            $client -> setCourriel(strtolower($client -> getPrenom()). "." .strtolower ($client -> getNom()). "@" .$this -> faker -> freeEmailDomain());
            $client -> setTelFixe($this -> faker -> numberBetween(0300000000, 0377777777));
            $client -> setTelPortable($this -> faker -> numberBetween(0601010101, 0701010101));
			$this -> addReference("client".$i, $client); 
			$manager ->persist($client);
		}
		$manager ->flush();
	}
}

