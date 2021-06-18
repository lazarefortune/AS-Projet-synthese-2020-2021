<?php
namespace App\Repository;

use App\Entity\Groupe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EvalGroupeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Groupe::class);
    }

    public function findByPromo($idPromo)
    {
        // $conn = $this->getEntityManager()->getConnection();

        // $sql = '
        //     SELECT * FROM groupe g, projet p
        //     WHERE g.id_projet = p.id
        //     AND p.id_promo_proj = :idPromo
        //     ';
        // $stmt = $conn->prepare($sql);
        // $stmt->execute(['idPromo' => $idPromo]);

        // // returns an array of arrays (i.e. a raw data set)
        // return $stmt->fetchAllAssociative();

        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT g
            FROM App\Entity\Groupe 
            WHERE g.id_projet = p.id 
            AND p.id_promo_proj = :idPromo'
        )->setParameter('idPromo', $idPromo);

        // returns an array of Product objects
        return $query->getResult();
    }


}