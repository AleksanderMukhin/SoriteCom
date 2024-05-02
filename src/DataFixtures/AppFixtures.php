<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Campus;

class CampusFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $campusNames = ['Campus A', 'Campus B', 'Campus C'];

        foreach ($campusNames as $name) {
            $campus = new Campus();
            $campus->setCNom($name);
            $manager->persist($campus);
        }

        $manager->flush();
    }
}

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
