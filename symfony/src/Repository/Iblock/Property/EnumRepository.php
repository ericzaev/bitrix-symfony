<?php

namespace App\Repository\Iblock\Property;

use App\Entity\Iblock\Property\Enum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Enum|null find($id, $lockMode = null, $lockVersion = null)
 * @method Enum|null findOneBy(array $criteria, array $orderBy = null)
 * @method Enum[]    findAll()
 * @method Enum[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Enum::class);
    }

    // /**
    //  * @return Enum[] Returns an array of Enum objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Enum
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
