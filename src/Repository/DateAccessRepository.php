<?php
// /src/Repository/MyEntityRepository.php
namespace App\Repository;

use App\Entity\DateAccesSout;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method MyEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyEntity[]    findAll()
 * @method MyEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DateAccessRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DateAccesSout::class);
    }

    // /**
    //  * @return MyEntity[] Returns an array of MyEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MyEntity
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}