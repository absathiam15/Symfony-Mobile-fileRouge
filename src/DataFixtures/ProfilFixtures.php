<?php

namespace App\DataFixtures;

//use App\Entity\Profil;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProfilFixtures extends Fixture
{
    const TAB=['ADMIN_SYSTEM','ADMIN_AGENCE','CAISSIER','USER_AGENCE'];

    public function load(ObjectManager $manager)
    {
        for ($p=0;$p<count(self::TAB);$p++){
           /* $profil= new Profil();
            $profil->setLibelle(self::TAB[$p]);
            $this->addReference(self::TAB[$p],$profil);
            $manager->persist($profil);*/
        }
        $manager->flush();
    }
}
