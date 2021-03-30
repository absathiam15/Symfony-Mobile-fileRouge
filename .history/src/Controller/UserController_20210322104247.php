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
       *  
       * )
     */
    public function addUser(): Response
    {
        dd('test');
    }
}
