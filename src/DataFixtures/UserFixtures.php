<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    private array $referenceTeam = array();
    private array $referenceEvent = array();
    private int $count = 0;
    public UserPasswordHasherInterface $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $encoder) {
        $this->passwordEncoder = $encoder;
    }

    public function mdp(User $user,$password):string{
        $pass = $this->passwordEncoder->hashPassword($user,$password);
        return $pass;
    }


    public function load(ObjectManager $manager): void{

        for($k=0;$k<30;$k++){
            $referenceTeam[] = $k;
        }

        for($s=0;$s<4;$s++) {
            $referenceEvent[] = $s;
        }

           for ($i=0;$i<10;$i++){
               $user = new User();
               $user->setEmail('user'.$i.'@gmail.com');
               $user->setCodePostal('750'.$i);
               $user->setPseudo('user'.$i);
               $user ->setFirstName('user'.$i);
               $user->setLastName('USER'.$i);
               $user->setNumTel('062586808'.$i);
               $user->setVille('ville'.$i);
               $user->setPassword($this->mdp($user,'symfony'.$i));
               $user->setRoles(['ROLES_USERS']);
               for($c=0;$c<3;$c++){
                   $randomKeyTeam = array_rand($referenceTeam,1);
                   $user->addTeam($this->getReference('team-'.$referenceTeam[$randomKeyTeam]));
                   unset($referenceTeam[array_search($referenceTeam[$randomKeyTeam], $referenceTeam)]);
               }

               /*
               if($this->count <4) {
                   $randomKeyEvent = array_rand($referenceEvent,1);
                   $user->addParent($this->getReference('event-'.$referenceEvent[$randomKeyEvent]));
                   unset($referenceEvent[array_search($referenceEvent[$randomKeyEvent], $referenceEvent)]);
               }
               */


               $manager->persist($user);
               $this->addReference('user-'.$i, $user);
           }



        $manager->flush();


    }

    public function getDependencies()
    {
        return array(
            TeamsFixtures::class
            //EventFixtures::class
        );
    }

}
