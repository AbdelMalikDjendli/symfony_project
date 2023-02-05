<?php

namespace App\DataFixtures;

use App\Entity\Team;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\UserFixtures;

class TeamsFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<30;$i++){
            $team = new Team();
            $team->setPlayer1('player1');
            $team->setPlayer2('player2');
            $team->setPlayer3('player3');
            $team->setPlayer4('player4');
            $team->setPlayer5('player5');
            $team->setName('team'.$i);
            $manager->persist($team);
            $this->addReference('team-'.$i, $team);
        }

        $manager->flush();
    }
}
