<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Agence;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserDataPersister implements ContextAwareDataPersisterInterface
{

    private $entityManager;
    private $encoder;
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Agence;
    }

    public function persist($data, array $context = [])
    {
        $password = $data->getPassword();
        // $data->setPassword($this->encoder->encodePassword($data, $password));
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }

    public function remove($data, array $context = [])
    {
        $data->setIsDeleted(true);
        $this->entityManager->persist($data);
        $this->entityManager->flush();
    }
}
