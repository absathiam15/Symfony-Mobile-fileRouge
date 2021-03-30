<?php

namespace App\Services;



use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class TransactionServices
{
    private $serializer;
    private $manager;
    public function __construct(EntityManagerInterface $manager, SerializerInterface $serializer) {

        $this->serializer = $serializer;
        $this->manager = $manager;
    }

    public function addTransactions()
    {
      dd('test');
    }

    public function calculateFrais($montant){
        $tab_frais= [
            [4999,425],
            [9999,850],
            [14999,1270],
            [19999,1695],
            [49999,2500],
            [59999,3000],
            [74999,4000],
            [119999,5000],
            [149999,6000],
            [199999,7000],
            [249999,8000],
            [299999,9000],
            [399999,12000],
            [499999,15000],
            [749999,22000],
            [899999,25000],
            [999999,27000],
            [1999999,30000]
        ];
        $a=0;
        while ($a < count($tab_frais)) {
            if ($tab_frais[$a][0]>$montant) {
                $frais= $tab_frais[$a][1];
                $a = count($tab_frais) + 1;
            }
            $a++;
        }
        if($a==count($tab_frais)){
            $frais= $montant*(2/100);
        }
        $fraisEtat = $frais*(40/100);
        $fraisDepot = $frais*(10/100);
        $fraisRetrait = $frais*(20/100);
        $fraisSystem = $frais*30/100;
        $commision= [
            "frais" => $frais,
            "etat"=>$fraisEtat,
            "depot"=>$fraisDepot,
            "retrait"=>$fraisRetrait,
            "system"=>$fraisSystem
        ];
        return $commision;
    }
}