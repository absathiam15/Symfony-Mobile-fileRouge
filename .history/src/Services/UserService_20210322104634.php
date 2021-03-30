<?php

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    private $serializer;
    private $manager;
    private $encoder;
public function __construct(EntityManagerInterface $manager, SerializerInterfac $serializer, UserPasswordEncoderInterface $encoder) {
    
    $this->serializer = $serializer;
    $this->manager = $manager;
    $this->encoder = $encoder;
}


    public function getRealProfil($profil)
    {
        $profil = explode("/",$profil);
        $profil_id=count($profil) -1;
        return $profil[$profil_id];
    }
}