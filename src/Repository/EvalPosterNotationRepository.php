<?php
namespace App\Repository;

use App\Entity\Groupe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EvalPosterNotationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Groupe::class);
    }

    public function findIsEvalNotationPoster($idEval, $idGroupe)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM eval_poster p
            WHERE p.id_groupe_eval_post = :idGroupe
            AND p.id_eval_post = :idEval
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['idGroupe' => $idGroupe,
            'idEval' => $idEval
        ]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }

    public function updateNoteGroupePoster($noteQual, $noteTrav, $noteCompet, $noteMoyenne, $idEval, $idGroupe){

        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        UPDATE eval_poster
            SET poster_qual_pres = :noteQual,
            poster_trav = :noteTrav,
            poster_compet = :noteCompet,
            poster_moyenne = :noteMoyenne
            WHERE id_groupe_eval_post = :idGroupe
            AND id_eval_post = :idEval
            ';
            
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'idGroupe' => $idGroupe,
            'idEval' => $idEval,
            'noteQual' => $noteQual,
            'noteTrav' => $noteTrav,
            'noteCompet' => $noteCompet,
            'noteMoyenne' => $noteMoyenne,
        ]);
        
    }

    public function insertNoteGroupePoster($noteQual, $noteTrav, $noteCompet, $noteMoyenne, $idEval, $idGroupe){

        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            INSERT INTO eval_poster
            VALUES(:idGroupe, :idEval, :noteQual,:noteTrav, :noteCompet, :noteMoyenne)
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'idGroupe' => $idGroupe,
            'idEval' => $idEval,
            'noteQual' => $noteQual,
            'noteTrav' => $noteTrav,
            'noteCompet' => $noteCompet,
            'noteMoyenne' => $noteMoyenne,
        ]);
        
    }

    public function selectAllNotesPoster($idGroupe){

        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT id_eval_post
            FROM eval_poster
            WHERE id_groupe_eval_post = :idGroupe;
        ';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'idGroupe' => $idGroupe,
        ]);
        
        return $stmt->fetchAllAssociative();
    }
}