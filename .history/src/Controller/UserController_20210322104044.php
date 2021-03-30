<?php

namespace App\Controller;
 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
       * @Route
       *  ( path="/api/admin/users", 
       *    methods={"POST"},
       *  defaults={
       *     "_controller"="\app\Controller\UserController::addUser",
       *     "_api_resource_class"=User::class,
       *     "_api_collection_operation_name"="addUser",
       *    }
       * )
     */
    public function addUser(): Response
    {
        dd('tesy');
    }
}
