<?php

namespace App\Controller;

use App\Repository\ProfilRepository;
use App\Repository\UserRepository;
use App\Services\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{

    private $dn;
    private $userServices;
    private $manager;
    public function __construct(UserService $userService, EntityManagerInterface $manager, DenormalizerInterface $denormalizer) 
    {

        $this->userService = $userService;
        $this->manager = $manager;
        $this->dn = $denormalizer;
    }
    /**
       * @Route
       *  ( path="/api/admin/users", 
       *    methods={"POST"}
       *  
       * )
     */
    public function addUser()
    {
     dd('test');
    }
}

