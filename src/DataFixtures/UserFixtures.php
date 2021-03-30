<?php

namespace App\DataFixtures;

use App\Entity\AdminAgence;
use App\Entity\AdminSystem;
use App\Entity\Caissier;
use App\Entity\User;
use App\Entity\UserAgence;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        for ($p=0;$p<16;$p++) {
            if ($p<4){
                $user = new User();
                $user ->setProfil($this->getReference('ADMIN_SYSTEM'));
            }
            elseif  ($p<8){
                $user = new AdminAgence();
                $user ->setProfil($this->getReference('ADMIN_AGENCE'));
            }
            elseif  ($p<12){
                $user = new Caissier();
                $user ->setProfil($this->getReference('CAISSIER'));
            }
            else{
                $user = new UserAgence();
                $user  ->setProfil($this->getReference('USER_AGENCE'));
            }

            $user = new User();
            $user->setNom($faker->lastName)
                ->setPrenom($faker->firstName)
                ->setUsername($faker->unique()->username)
                ->setEmail($faker->email)
                ->setPassword($this->encoder->encodePassword($user, 'passer'))
                ->setStatut(0)
                ->setTelephone(770912122);
            //
            $manager->persist($user);
            $manager->flush();
        }


    }

    public function getDependencies()
    {
        // TODO: Implement getDependencies() method.
        return array(
            ProfilFixtures::class
        );

    }

}
