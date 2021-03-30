<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;
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

    public function addUser(UserRepositor $userRepo, $id, Request $request, ProfilRepository $profilRepo, SerializerInterface $serializer)
    {
        dd('test');
     $user = $userRepo->find($id); 
    //     dd($user);
    //     $data = $request->request->all();
    //     $avatar = $request->files->get("avatar");
    //     if($avatar) {
    //         $avatar = fopen($avatar->getRealPath(), "rb"); 
    //         $data["photo"] = $avatar;
    //     }

    //     $profil_id = $this->userServices->getRealProfil($data["profil"]);
    //     $profil = $profilRepo->find($profil_id);

    //     $user->setPrenom($data ["prenom"])
    //         ->setNom($data ["nom"])
    //         ->setAdresse($data ["adresse"])
    //         ->setGenre($data ["genre"])
    //         ->setTelephone($data ["telephone"])
    //         ->setEmail($data ["email"])
    //         ->setPassword($data ["password"])
    //         ->setUsername($data ["username"])
    //         ->setAvatar($avatar)
    //         ->setProfil($profil);

    //         $this->manager->flush();
    //         return new JsonResponse("La modification a été enregistré avec success", Response::HTTP_CREATED, [], true);

 
    //
 }
}