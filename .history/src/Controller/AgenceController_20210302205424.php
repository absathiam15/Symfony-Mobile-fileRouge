<?php

namespace App\Controller;

use App\Entity\Agence;
use App\Repository\AgenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AgenceController extends AbstractController
{
    /**
     * @Route(
     
     * ) 
     */
    public function addAgence(Request $request, EntityManagerInterface $manager)
    {
    //     $agence = $request->toArray();
    //     $agence = $this->serializer->denormalize($agence);
    //   // dd($agence);

    //    $manager->persist($agence);
    //    $manager->flush();
    //    return $this->json("Vous avez enregistre un nouveau apprenant",200);        
    // 
    }
}
 