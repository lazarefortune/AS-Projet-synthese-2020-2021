<?php
namespace App\Repository;

use App\Entity\Groupe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EvalSoutNotationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Groupe::class);
    }

    public function findIsEvalNotationSout($idEval, $idGroupe)
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM eval_sout p
            WHERE p.id_groupe_eval_sout = :idGroupe
            AND p.id_eval_sout = :idEval
            ';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['idGroupe' => $idGroupe,
            'idEval' => $idEval
        ]);

        // returns an array of arrays (i.e. a raw data set)
        return $stmt->fetchAllAssociative();
    }

    public function updateNoteGroupeSout($noteQual, $noteTrav, $noteCompet, $noteMoyenne, $idEval, $idGroupe){

        $conn = $this->getEntityManager()->getConnection();
        $sql = '
        UPDATE eval_sout
            SET sout_qual_pres = :noteQual,
            sout_trav = :noteTrav,
            sout_compet = :noteCompet,
            sout_moyenne = :noteMoyenne
            WHERE id_groupe_eval_sout = :idGroupe
            AND id_eval_sout = :idEval
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

    public function insertNoteGroupeSout($noteQual, $noteTrav, $noteCompet, $noteMoyenne, $idEval, $idGroupe){

        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            INSERT INTO eval_sout
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
}