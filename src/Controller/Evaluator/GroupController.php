<?php

namespace App\Controller\Evaluator;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GroupController extends AbstractController
{

    public function group_list(): Response
    {

        return $this->render('evaluator/group/group_list.html.twig');
    }

    // public function group_notes(int $groupId): Response
    // {
        
    //     return $this->render('evaluator/group/notes/show.html.twig',[
    //             'groupId' => $groupId
    //         ]);
    // }

    // Path view evaluator
    public function group_notes_sout(int $groupId): Response
    {
        return $this->render('evaluator/group/notes/students_sout.html.twig',[
            'groupId' => $groupId
            ]);
    }

    public function group_notes_poster(int $groupId): Response
    {
        return $this->render('evaluator/group/notes/students_poster.html.twig',[
            'groupId' => $groupId
            ]);
    }
 
}
