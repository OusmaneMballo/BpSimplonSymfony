<?php

namespace App\Repository;

use App\Entity\FraisBancaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FraisBancaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method FraisBancaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method FraisBancaire[]    findAll()
 * @method FraisBancaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FraisBancaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FraisBancaire::class);
    }

    // /**
    //  * @return FraisBancaire[] Returns an array of FraisBancaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FraisBancaire
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
