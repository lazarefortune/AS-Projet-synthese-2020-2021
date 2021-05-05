<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GroupController extends AbstractController
{
    public function group_list(): Response
    {

        return $this->render('admin/group/group_list.html.twig');
    }

    public function group_notes(int $groupId): Response
    {
        
        return $this->render('admin/group/notes/show.html.twig',[
            'groupId' => $groupId
            ]);
    }

    public function edit_note(int $groupId, string $typeEval){
        if ($typeEval == "soutenance") {
            return $this->render('admin/group/notes/edit_sout.html.twig',[
                'groupId' => $groupId
                ]);
        }
        if ($typeEval == "poster") {
            return $this->render('admin/group/notes/edit_poster.html.twig',[
                'groupId' => $groupId
                ]);
        }
    }
}
