<?php

namespace App\Controller;

use App\Entity\Empleado;
use App\Entity\Persona;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncode;

class CrearPersonaController extends AbstractController
{
    #[Route('/crear/persona', name: 'app_crear_persona')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $request=Request::createFromGlobals();
        $data=json_decode($request->getContent(),true);

        $entityManager = $doctrine->getManager();
        $persona= new Persona();
        $persona->setNombre($data['nombre']);
        $persona->setApellido($data['apellido']);
        $persona->setCelular($data['celular']);
        $empleo=$doctrine->getRepository(Empleado::class)->find($data['empleo']);

        $persona->setEmpleo($empleo);

        $entityManager->persist($persona);

        $entityManager->flush();

        return new Response(json_encode(['respuesta'=>'Se guardaron los datos de la persona con ID:'.$persona->getId()]));
    }
}
