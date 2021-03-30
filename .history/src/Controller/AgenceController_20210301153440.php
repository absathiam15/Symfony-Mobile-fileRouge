<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgenceController extends AbstractController
{
    /**
     * @Route(
     * name="addUser",
     * path="/api/admin/users",
     * methods={"POST"},
     * defaults={
     *      "_controller"="\app\ControllerUserController::addUser",
     *      "_api_resource_class"=User::class,
     *      "_api_collection_operation_name"="add_user",
     *    }
     * ) 
     */
    public function index(): Response
    {
        return $this->render('agence/index.html.twig', [
            'controller_name' => 'AgenceController',
        ]);
    }
}
 