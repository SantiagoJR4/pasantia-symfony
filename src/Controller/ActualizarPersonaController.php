<?php

namespace App\Controller;

use App\Entity\Persona;
use App\Entity\Empleado;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ActualizarPersonaController extends AbstractController
{
    #[Route('/actualizar/persona/{id}', name: 'app_actualizar_persona')]
    public function index(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $request=Request::createFromGlobals();
        $data=json_decode($request->getContent(),true);
        $persona = $entityManager->getRepository(Persona::class)->find($id);
        
        if (!$persona) {
            throw $this->createNotFoundException(
                'No person found for id '.$id
            );
        }

        $persona->setNombre($data['nombre']);
        $persona->setApellido($data['apellido']);
        $persona->setCelular($data['celular']);
        $empleo=$doctrine->getRepository(Empleado::class)->find($data['empleo']);
        $persona->setEmpleo($empleo);

        $entityManager->flush();

        $response = new Response();
        $response->setContent(json_encode(['respuesta'=>'Se actualizó correctamente la persona con ID:'.$persona->getId()]));
        $response->headers->set('Content-Type','application/json');

        return $response;
    }
}
