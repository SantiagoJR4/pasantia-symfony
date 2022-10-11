<?php

namespace App\Controller;

use App\Entity\Empleado;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class EmpleadoController extends AbstractController
{
    #[Route('/empleado/{id}', name: 'app_empleado')]
    public function index(Empleado $empleado, SerializerInterface $serializer): Response
    {
        $serializer=$serializer->serialize($empleado,'json');
        return new Response($serializer);
    }
}
