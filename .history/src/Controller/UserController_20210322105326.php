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
    public function addUser(UserRepository $userRepo, $id, Request $request, ProfilRepository $profilRepo, SerializerInterface $serializer)
    {
        dd('test')
        $user = $userRepo->find($id); 
        dd($user);
        $data = $request->request->all();
        $avatar = $request->files->get("avatar");
        if($avatar) {
            $avatar = fopen($avatar->getRealPath(), "rb"); 
            $data["photo"] = $avatar;
        }

        $profil_id = $this->userServices->getRealProfil($data["profil"]);
        $profil = $profilRepo->find($profil_id);

        $user->setPrenom($data ["prenom"])
            ->setNom($data ["nom"])
            ->setAdresse($data ["adresse"])
            ->setGenre($data ["genre"])
            ->setTelephone($data ["telephone"])
            ->setEmail($data ["email"])
            ->setPassword($data ["password"])
            ->setUsername($data ["username"])
            ->setAvatar($avatar)
            ->setProfil($profil);

            $this->manager->flush();
            return new JsonResponse("La modification a été enregistré avec success", Response::HTTP_CREATED, [], true);

 
    }
}

