<?php

namespace App\Controller;

use App\Entity\Agence;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AgenceController extends AbstractController
{
    /**
     * @Route(
     * name="addUser",
     * path="/api/admin/agences",
     * methods={"POST"},
     * defaults={
     *      "_controller"="\app\ControllerAgenceController::addAgence",
     *      "_api_resource_class"=Agence::class,
     *      "_api_collection_operation_name"="add_Agence",
     *    }
     * ) 
     */
    public function addAgence(): Response
    {
        return $this->render('agence/index.html.twig', [
            'controller_name' => 'AgenceController',
        ]);
    }
}
 