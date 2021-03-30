<?php

namespace App\Services;



class UserService
{
    private $serializer;
    private $manager;
    private $encoder;
public function __construct(EntityManagerInterface $manager, SerializerInterface $serializer, UserPasswordEncoderInterface $encoder) {
    
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