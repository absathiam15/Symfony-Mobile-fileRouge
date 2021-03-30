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
    //dd('test');
    
 }
    
    
}