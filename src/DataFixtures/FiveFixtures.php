<?php

namespace App\DataFixtures;

use App\Entity\Five;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class FiveFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<4;$i++){
            $five = new Five();

            $five->setName('five'.$i);
            $five->setPrice(10+$i);
            $five->setAddress($i.' rue du five');
            $five->setTimetable('10h-'.(18+$i).'h');
            $five->addEvent($this->getReference("event".$i));
            $manager->persist($five);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            EventFixtures::class,
            //EventFixtures::class
        );
    }
}
