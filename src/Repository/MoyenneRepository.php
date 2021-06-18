<?php
namespace App\Repository;

use App\Entity\Groupe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MoyenneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Groupe::class);
    }

    public function moyenneSout($idGroupe)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT ROUND(AVG(sout_moyenne),2) as moySoutenance 
            FROM eval_sout p
            WHERE p.id_groupe_eval_sout = :idGroupe
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['idGroupe' => $idGroupe]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }

    public function moyennePoster($idGroupe)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT ROUND(AVG(poster_moyenne),2) as moyPoster
            FROM eval_poster p
            WHERE p.id_groupe_eval_post = :idGroupe
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['idGroupe' => $idGroupe]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }
}