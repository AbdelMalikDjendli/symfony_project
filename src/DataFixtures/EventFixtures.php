<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EventFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<4;$i++){
            $event = new Event();
            $event->setDate("2".$i.'/03/2023');
            $event->setDescription('five detente');
            $event->setLevel('bon');
            $event->setHour('18h00');
            $event->setOrganizer($this->getReference('user-'.rand(0,30)));
            $manager->persist($event);
            $this->addReference('event-'.$i, $event);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class
            //EventFixtures::class
        );
    }
}
