<?php

namespace App\Repository;

use App\Entity\ImageSubproject;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImageSubproject>
 *
 * @method ImageSubproject|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageSubproject|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageSubproject[]    findAll()
 * @method ImageSubproject[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageSubprojectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageSubproject::class);
    }

    //    /**
    //     * @return ImageSubproject[] Returns an array of ImageSubproject objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ImageSubproject
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
