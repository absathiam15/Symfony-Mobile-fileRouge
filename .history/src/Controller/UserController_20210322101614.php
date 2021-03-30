<?php

namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
       * @Route
       *  ( path="/api/admin/users"", methods={"POST"},
       *  defaults={
       *     "_controller"="\app\Controller\TransactionController::depotTransaction",
       *     "_api_resource_class"=Transactions::class,
       *     "_api_collection_operation_name"="depotTransaction",
       *    }
       * )
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
