<?php

namespace App\Repository;

use App\Entity\Subproject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Subproject>
 *
 * @method Subproject|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subproject|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subproject[]    findAll()
 * @method Subproject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubprojectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subproject::class);
    }

    public function findByProject($search): array
    {
        return $this->createQueryBuilder('s')
        //je veux selectionner la table subproject et project
            ->select('s', 'p')
            // j'indique le join, la cle etrangere etant project_id, doctrine detecte automatiquement donc je dois preciserr l entite uniquement + l allias de la table
            ->join('s.project', 'p')
            ->where('p.title LIKE :search')
            ->setParameter('search', '%' . $search . '%')
            ->orderBy('p.title', 'ASC')
            ->getQuery()
            ->getResult();
    }


    //    /**
    //     * @return Subproject[] Returns an array of Subproject objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Subproject
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
