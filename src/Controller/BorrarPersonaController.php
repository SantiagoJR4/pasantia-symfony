<?php

namespace App\Controller;

use App\Entity\Persona;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BorrarPersonaController extends AbstractController
{
    #[Route('/borrar/persona/{id}', name: 'app_borrar_persona')]
    public function index(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager=$doctrine->getManager();
        $personaDelete=$entityManager->getRepository(Persona::class)->find($id);

        if (!$personaDelete) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $entityManager->remove($personaDelete);
        $entityManager->flush();
        $response = new Response();
        $response->setContent(json_encode(['respuesta'=>'Se elimino correctamente']));
        $response->headers->set('Content-Type','application/json');

        return $response;
    }
}
