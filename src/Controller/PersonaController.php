<?php

namespace App\Controller;

use App\Entity\Persona;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PersonaController extends AbstractController
{
    #[Route('/persona', name: 'app_persona')]
    public function index(ManagerRegistry $doctrine, SerializerInterface $serializer): Response
    {
        $datos=$doctrine->getRepository(Persona::class)->findAll();
        $jsonContent= $serializer->serialize($datos,'json', ['groups'=>['persona','empleo']]);
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type','application/json');

        return $response;
    }
}
