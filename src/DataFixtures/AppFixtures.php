<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Five;
use App\Entity\Team;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        public UserPasswordHasherInterface $encoder,
    )
    {
    }

    public function load(ObjectManager $manager): void
    {
        $admin = $this->makeAdminUser();
        $manager->persist($admin);
        $stringNames = array("laurent", "philippe", "nicolas", "jerome", "leonard", "francis", "remy", "gilbert", "sofiane", "louis", "rene");
        $users = $this->generateUsers($manager, $stringNames);
        $teams = new ArrayCollection();

        foreach($users as $user){
            $team = $this->makeTeam($user, $stringNames);
            $manager->persist($team);
            $teams->add($team);
        }

        $fives = $this->generateFives($manager);

        $hours = array(12, 13, 14, 15, 16, 17, 18, 19, 20);
        $levels = array("beginner", "intermediate", "confirmed");

        $oldMatches = $this->generatePlayedMatches($manager, $users, $fives, $hours, $levels, $teams);

        $matchesToJoin = $this->generateMatches($manager, $users, $fives, $hours, $levels, $teams);


        $manager->flush();
    }

    public function makeTeam(User $user, array $names):Team
    {
        $team = new Team();
        $team->setCreator($user);
        $team->setPlayer1($names[3]);
        $team->setPlayer2($names[4]);
        $team->setPlayer3($names[5]);
        $team->setPlayer4($names[6]);
        $team->setPlayer5($names[7]);
        $team->setName($user->getPseudo()." FC");

        return $team;

    }

    public function generateMatches(ObjectManager $manager, $users, $fives, $hours, $levels, $teams):ArrayCollection
    {
        $matches = new ArrayCollection();

        $indexUser = 0;
        $indexFive = 0;
        $indexHour = 0;
        $indexLevel = 0;

        for($i = 1; $i <= 31; $i = $i + 1){
            $match = $this->makeEvent($i, $users[$indexUser], $fives[$indexFive], $hours[$indexHour], $levels[$indexLevel], $teams[$indexUser]);
            $manager->persist($match);
            $matches->add($match);
            $indexUser = ($indexUser + 3) % 11;
            $indexFive = ($indexFive + 1) % 2;
            $indexHour = ($indexHour + 2) % 9;
            $indexLevel = ($indexLevel + 2) % 3;
        }

        return $matches;
    }

    public function generatePlayedMatches($manager, $users, $fives, $hours, $levels, $teams):ArrayCollection
    {
        $matches = new ArrayCollection();

        $indexUser = 0;
        $indexFive = 0;
        $indexHour = 0;
        $indexLevel = 0;

        for($i = 1; $i <= 31; $i = $i + 1){
            $indexOpponent = ($indexUser + 1 + $indexHour) % 11;
            $match = $this->makePlayedEvent($i, $users[$indexUser], $fives[$indexFive], $hours[$indexHour], $levels[$indexLevel], $teams[$indexUser], $users[$indexOpponent], $teams[$indexOpponent]);
            $manager->persist($match);
            $matches->add($match);
            $indexUser = ($indexUser + 3) % 11;
            $indexFive = ($indexFive + 1) % 2;
            $indexHour = ($indexHour + 2) % 9;
            $indexLevel = ($indexLevel + 2) % 3;
        }

        return $matches;
    }

    public function makePlayedEvent(int $day, User $user, Five $five, string $hour, string $level, Team $teamUser, User $opponent, Team $teamOpponent):Event
    {
        $match = new Event();
        if($day<10){
            $match->setDate(new \DateTimeImmutable("0".$day."-03-2023"));
        }
        else {
            $match->setDate(new \DateTimeImmutable($day."-03-2023"));
        }
        $match->setOrganizer($user);
        $match->addTeam($teamUser);
        $match->addTeam($teamOpponent);
        $match->setInvited($opponent->getPseudo());
        if($day % 2 == 0){
            $match->setWinner($user->getPseudo());
            $match->setLooser($opponent->getPseudo());
        }
        else{
            $match->setWinner($opponent->getPseudo());
            $match->setLooser($user->getPseudo());
        }
        $match->setFive($five);
        $match->setHour($hour.":00:00");
        $match->setLevel($level);

        return $match;
    }

    public function makeEvent(int $day, User $user, Five $five, string $hour, string $level, Team $team):Event
    {
        $match = new Event();
        if($day<10){
            $match->setDate(new \DateTimeImmutable("0".$day."-05-2023"));
        }
        else {
            $match->setDate(new \DateTimeImmutable($day."-05-2023"));
        }
        $match->setOrganizer($user);
        $match->addTeam($team);
        $match->setFive($five);
        $match->setHour($hour.":00:00");
        $match->setLevel($level);

        return $match;
    }

    public function makeAdminUser():User
    {
        $admin = new User();
        $password = $this->encoder->hashPassword($admin, "TestingVersion11");
        $admin->setPassword($password);
        $admin->setPseudo("admin");
        $admin->setEmail("admin@gmail.com");
        $this->setDefaultParameters($admin);
        $admin->setRoles(['ROLE_ADMIN']);
        return $admin;
    }

    public function generateUsers(ObjectManager $manager, array $stringNames):ArrayCollection
    {
        $users = new ArrayCollection();
        foreach($stringNames as $name){
            $user = $this->makeUser($name);
            $manager->persist($user);
            $users->add($user);
        }
        return $users;
    }

    public function generateFives(ObjectManager $manager):array
    {
        $urbanSoccer = new Five();
        $urbanSoccer->setName("Urban Soccer Aubervilliers");
        $urbanSoccer->setAddress("Aubervilliers");
        $urbanSoccer->setTimetable("12h à 20h");
        $urbanSoccer->setPrice(8);
        $manager->persist($urbanSoccer);

        $laVillette = new Five();
        $laVillette->setName("Le FIVE Villette");
        $laVillette->setAddress("La Villette");
        $laVillette->setTimetable("12h à 20h");
        $laVillette->setPrice(9);
        $manager->persist($laVillette);

        return array($urbanSoccer, $laVillette);
    }

    public function makeUser(string $name):User
    {
        $user = new User();
        $user->setPseudo($name);
        $user->setEmail($name."@gmail.com");
        $password = $this->encoder->hashPassword($user, "TestingVersion11");
        $user->setPassword($password);
        $this->setDefaultParameters($user);
        return $user;
    }
    public function setDefaultParameters(User $user):void
    {
        $user->setVille("Paris");
        $user->setFirstName("default_first_name");
        $user->setLastName("default_last_name");
        $user->setCodePostal("75012");
        $user->setNumTel("O623930234");
        $user->setNbNote(5);
        $user->setNote(20);
    }

}
