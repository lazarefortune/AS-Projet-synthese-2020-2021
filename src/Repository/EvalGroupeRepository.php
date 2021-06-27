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

    public function findAllGroupSout($idEval){

        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT id_groupe_eval_sout FROM eval_sout p
            WHERE p.id_eval_sout = :idEval
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'idEval' => $idEval
        ]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }
    
    public function findAllGroupPost($idEval){

        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT id_groupe_eval_post FROM eval_poster p
            WHERE p.id_eval_post = :idEval
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'idEval' => $idEval
        ]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }

    public function checkIfNoteExistSout($idEval, $idGroupe){

        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT sout_moyenne FROM eval_sout p
            WHERE p.id_eval_post = :idEval
            AND p.id_groupe_eval_sout = :idGroupe
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'idEval' => $idEval,
            'idGroupe' => $idGroupe
        ]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAll();
    }
}