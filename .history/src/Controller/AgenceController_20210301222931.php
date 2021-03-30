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
     * path="/api/admin/agences",
     * methods={"POST"},
     * defaults={
     *      "_controller"="\app\ControllerAgenceController::addAgence",
     *      "_api_resource_class"=Agence::class,
     *      "_api_collection_operation_name"="add_Agence",
     *    }
     * ) 
     */
    public function addAgence(Request $request, EntityManagerInterface $manager)
    {
        $agence = $request->toArray();
       // $data = $this->serializer->denormalize($agence);
       dd($data);

       $this->manager->persist($data);
    }
}
 