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
       *    methods={"POST"}
       *  
       * )
     */
    public function addUser()
    {
        $user = $userRepo->find($id); 
       // dd($user);
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
