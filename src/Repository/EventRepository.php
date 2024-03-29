<?php

namespace App\Repository;

use App\Entity\Event;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 *
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }


    public function save(Event $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Event $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   public function findMatchCreatedOrJoinded($id,$pseudo): array
   {
       return $this->createQueryBuilder('e')
           ->andWhere('e.invited = :pseudo')
           ->orWhere('e.organizer=:id')
           ->setParameter('id', $id)
           ->setParameter('pseudo', $pseudo)
          ->orderBy('e.date', 'DESC')
          ->getQuery()
           ->getResult()
           ;
   }

   //fonction qui va trouver les matchs joignables en fonction de l'utilisateur connecté
   public function findUserJoinableMatches(User $user, $fiveFilter = null, $levelFilter = null): array{
       //initialisation de la requête
        $query = $this->createQueryBuilder('m');

       // si un filtre a été appliqué pour les five
        if($fiveFilter != null){

            //filtre les fives
            $query->andWhere('m.five IN(:fives)')
                ->setParameter(':fives', array_values($fiveFilter));
        }

        // si un filtre a été appliqué pour le niveau
       if($levelFilter != null){

           //filtre les niveaux
           $query->andWhere('m.level IN(:levels)')
               ->setParameter(':levels', array_values($levelFilter));
       }

       return $query
           ->andWhere('m.invited IS NULL')
           ->andWhere('m.organizer != :user')
           ->setParameter('user', $user)
           ->orderBy('m.date', 'ASC')
           ->getQuery()
           ->getResult();

   }

   // même principe que la fonction précédente mais pas d'utilisateur connecté
   public function findJoinableMatches($fiveFilter = null, $levelFilter = null): array{
        $query = $this -> createQueryBuilder('m');

       if($fiveFilter != null){
           //les fives font ils partis des fives choisis par l'utilisateurs
           $query->andWhere('m.five IN(:fives)')
               ->setParameter(':fives', array_values($fiveFilter));
       }

       if($levelFilter != null){
           //les fives font ils partis des niveaux choisis par l'utilisateurs
           $query->andWhere('m.level IN(:levels)')
               ->setParameter(':levels', array_values($levelFilter));
       }

       return $query
           ->andWhere('m.invited IS NULL')
           ->orderBy('m.date', 'ASC')
           ->getQuery()
           ->getResult();
   }
    public function findMatchWin($pseudo): array
    {
        return $this->createQueryBuilder('e')
            ->Where('e.winner = :pseudo')
            ->setParameter('pseudo', $pseudo)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findMatchLoose($pseudo): array
    {
        return $this->createQueryBuilder('e')
            ->Where('e.looser = :pseudo')
            ->setParameter('pseudo', $pseudo)
            ->getQuery()
            ->getResult()
            ;
    }

}
