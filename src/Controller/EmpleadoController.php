<?php

namespace App\Controller;

use App\Entity\Empleado;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class EmpleadoController extends AbstractController
{
    #[Route('/empleo', name: 'app_empleado')]
    public function index(ManagerRegistry $doctrine, SerializerInterface $serializer): Response
    {
        $datos=$doctrine->getRepository(Empleado::class)->findAll();
        $jsonContent= $serializer->serialize($datos,'json', ['groups'=>['empleo']]);
        $response = new Response($jsonContent);
        $response->headers->set('Content-Type','application/json');

        return $response;
    }
}
