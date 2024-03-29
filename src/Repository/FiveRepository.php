<?php

namespace App\Repository;

use App\Entity\Five;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Five>
 *
 * @method Five|null find($id, $lockMode = null, $lockVersion = null)
 * @method Five|null findOneBy(array $criteria, array $orderBy = null)
 * @method Five[]    findAll()
 * @method Five[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FiveRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Five::class);
    }

    public function save(Five $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Five $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

}
