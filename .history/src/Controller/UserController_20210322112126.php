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
    public function addUser(UserRepository $userRepo, Request $request)
    {
    //dd('test');
    $userObjet = $request->toArray();
        //dd($userObjet);
        $profil_id = $this->userService->getRealProfil($userObjet["profil"]);
        //dd($profil_id);
        $profil = $profilRepo->find($profil_id);

        $entity = ucfirst(strtolower($profil->getLibelle($profil)));
        

        $entity = "App\Entity\\".$entity;
        $user_to_save = $this->serializer->denormalize($userObjet, $entity);
        $user_to_save->setPassword($this->encoder->encodePassword($user, "password"));
        $user_to_save->setProfil($profil);
        $avatar = $request->files->get("avatar");

        if(!empty($avatar)) {
            $this->uploadImage($avatar,$user_to_save);
        }
      // dd($user_to_save);
       //return "ok";
       return $user_to_save;
 }
}

