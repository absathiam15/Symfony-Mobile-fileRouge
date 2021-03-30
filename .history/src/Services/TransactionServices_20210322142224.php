<?php

namespace App\Services;

use App\Entity\Transactions;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class TransactionServices
{
    private $serializer;
    private $manager;
    public function __construct(EntityManagerInterface $manager, SerializerInterface $serializer, ValidatorInterface $validator) {

        /* $this->serializer = $serializer;
        $this->manager = $manager;
        $this->validator = $validator; */
    } 
 
    public function addTransactions()
    {
    //   dd('test');
    }

     public function generateCodeTransaction(){
        $codeGenere = strval(random_int(000, 999))."-".strval(random_int(000, 999))."-".strval(random_int(000, 999));
        return $codeGenere;
    }

     public function frais($montant) {
            if ($montant>0 && $montant<=5000){
                return 425;
            }
            if ($montant>5000 && $montant<=10000){
                return 850;
            }
            if ($montant>10000 && $montant<=15000){
                return 1270;
            }
            if ($montant>15000 && $montant<=20000){
                return 1695;
            }
            if ($montant>20000 && $montant<=50000){
                return 2500;
            }
            if ($montant>50000 && $montant<=60000){
                return 3000;
            }
            if ($montant>60000 && $montant<=75000){
                return 4000;
            }
            if ($montant>75000 && $montant<=120000){
                return 5000;
            }
            if ($montant>120000 && $montant<=150000){
                return 6000;
            }
            if ($montant>150000 && $montant<=200000){
                return 7000;
            }
            if ($montant>200000 && $montant<=250000){
                return 8000;
            }
            if ($montant>250000 && $montant<=300000){
                return 9000;
            }
            if ($montant>300000 && $montant<=400000){
                return 12000;
            }
            if ($montant>400000 && $montant<=750000){
                return 15000;
            }
            if ($montant>750000 && $montant<=900000){
                return 22000;
            }
            if ($montant>900000 && $montant<=1000000){
                return 25000;
            }
            if ($montant>1000000 && $montant<=1125000){
                return 27000;
            }
            if ($montant>1125000 && $montant<=1400000){
                return 30000;
            }
            if ($montant>1400000 && $montant<=2000000){
                return 30000;
            }
            if ($montant>2000000){
                return ($montant*2)/100;
            }
     }
    //commission agence depot
    public function fraisDepot($frais)
    {
        return ($frais*10)/100;
    }

    //commission agence retrait
    public function fraisRetrait($frais)
    {
        return ($frais*20)/100;
    }

    //commission pour entreprise
    public function fraisSysteme($frais)
    {
        return ($frais*30)/100;
    }

    //commission etat
    public function fraisEtat($frais)
    {
        return ($frais*40)/100;
    }

    public function validationCni($cni){
        if (ctype_digit($cni)){
            if (strlen($cni)==13){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    public function validationTelephone($telephone){
        if (ctype_digit($telephone)){
            if (strlen($telephone)==9){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    //  public function sendMessage(User $user, Transactions $transaction, String $typeTransaction, TexterInterface $texter){
    //         if ($typeTransaction == 'depot'){
    //             $clientDepot=$transaction->getClientDepot()->getNomComplet();
    //             $montant=$transaction->getMontant();
    //             $codeTrans=$transaction->getCodeTrans();
    //             $telephoneClientRetrait=$transaction->getClientRetrait()->getTelephone();
    //             $sms = new SmsMessage(
    //             // the phone number to send the SMS message to
    //                 $telephoneClientRetrait,
    //                 // the message
    //                 'Bienvenue sur Money SA '.$clientDepot.' vous a envoye '.$montant.' FCFA. Votre code de transaction est: '.$codeTrans.'.'
    //             );
    //             $sentMessage = $texter->send($sms);
    //         }
    //         else{
    //             $clientRetrait=$transaction->getClientRetrait()->getNomComplet();
    //             $clientDepot=$transaction->getClientDepot()->getNomComplet();
    //             $montant=$transaction->getMontant();
    //             $codeTrans=$transaction->getCodeTrans();
    //             $telephoneClientDepot=$transaction->getClientDepot()->getTelephone();
    //             $sms = new SmsMessage(
    //             // the phone number to send the SMS message to
    //                 $telephoneClientDepot,
    //                 // the message
    //                 'Bienvenue sur Money SA '.$clientRetrait.' vient de recuperer son argent.'
    //             );

    //             $sentMessage = $texter->send($sms);
    //         }


    //  }


}
