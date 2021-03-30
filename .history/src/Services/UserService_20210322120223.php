<?php

namespace App\Services;

use App\Repository\ProfilRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;

class UserService
{
    private $serializer;
    private $manager;
    public function __construct(EntityManagerInterface $manager, SerializerInterface $serializer) {
        
        $this->serializer = $serializer;
        $this->manager = $manager;
    }

    public function getRealProfil($profil)
    {
        $profil = explode("/",$profil);
        $profil_id=count($profil) -1;
        return $profil[$profil_id];
    }

    public function addUser($user, UserRepository $userRepo, Request $request, ProfilRepository $profilRepo, SerializerInterface $serializer)
    {
        $userObjet = $request->toArray();
        //dd($userObjet);
        $profil_id = $this->userService->getRealProfil($userObjet["profil"]);
        //dd($profil_id);
        $profil = $profilRepo->find($profil_id);
       // dd($profil_id);
        $entity = ucfirst(strtolower($profil->getLibelle($profil)));
        //dd($entity);

        $entity = "App\Entity\\".$entity;
        $user_to_save = $this->serializer->denormalize($userObjet, $entity);
        $user_to_save->setPassword($this->encoder->encodePassword($user, "password"));
        $user_to_save->setProfil($profil);
        dd($user_to_save);
       
        return $this->json("l'utilisateur a été enregistré avec success", Response::HTTP_CREATED, [], true);    

    
 }
    
    
}