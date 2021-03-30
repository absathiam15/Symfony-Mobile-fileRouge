<?php

namespace App\DataFixtures;

use App\Entity\Transactions;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TransactionsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker= Factory::create('fr_FR');

        for ($p = 0; $p < 16; $p++) {

        $transaction = new Transactions();
        $transaction->setMontantr($faker->lastName)
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
}
