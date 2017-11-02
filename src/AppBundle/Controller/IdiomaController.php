<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Idioma;

class IdiomaController extends FOSRestController
{

  /**
   * @Rest\Get("/idiomas")
   */
  public function idiomasAction(Request $request)
  {
      // entity manager
      $em = $this->getDoctrine()->getManager();

      // repo idiomas
      $repoIdiomas = $em->getRepository('AppBundle:Idioma');
      $output = array();

      $idiomas= $repoIdiomas->findAll();

      if ($idiomas) {
          foreach($idiomas as $idioma) {

              //idioma

              $output[] = array(
                  'id'          => $idioma->getId(),
                  'nombre'      => $idioma->getNombre(),
              );
          }
          return new View($output, Response::HTTP_OK);
      } else {
          return new View('No existen idiomas aun.', Response::HTTP_NOT_FOUND);
      }
  }

  /**
     * @Rest\Get("/idiomas/{id}")
     */
    public function idiomaAction(Request $request, $id)
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();

        // repo idioma
        $repoIdioma= $em->getRepository('AppBundle:Idioma');
        $output = array();

        // busca la idioma
        $idioma = $repoIdioma->find($id);

        if ($idioma) {

            //idiomas
            $output = array(
                'id'          => $idioma->getId(),
                'nombre'      => $idioma->getNombre(),
            );

            return new View($output, Response::HTTP_OK);
        } else {
            return new View('Idioma no encontrada', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @Rest\Post("/idiomas")
     */
    public function postIdiomaAction(Request $request)
    {
        // entity manager
        $em = $this->getDoctrine()->getManager();

        //parametros de la petición
        $nombre = $request->request->get('nombre');

        // entidad
        $idioma = new Idioma();
        $idioma->setNombre($nombre);

        // persistencia
        try {
            $em->persist($idioma);
            $em->flush();
            return new View('Creación satisfactoria.', Response::HTTP_CREATED);
        } catch (exception $e) {
            return new View('Se presentó un error.', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
      * @Rest\Put("/idiomas/{id}")
      */
     public function putIdiomaAction(Request $request, $id)
     {
         // entity manager y repo
         $em = $this->getDoctrine()->getManager();
         $repoIdiomas = $em->getRepository('AppBundle:Idioma');

         //parametros de la petición
         $nombre = $request->request->get('nombre');

         // entidad
         $idioma = $repoIdiomas->find($id);
         $idioma->setNombre($nombre);

         // persistencia
         try {
             $em->persist($idioma);
             $em->flush();
             return new View('Actualizacion satisfactoria.', Response::HTTP_CREATED);
         } catch (exception $e) {
             return new View('Se presentó un error.', Response::HTTP_INTERNAL_SERVER_ERROR);
         }
     }

   /**
   * @Rest\Delete("/idiomas/{id}")
   */
  public function deleteIdiomaAction(Request $request, $id)
  {
      // entity manager
      $em = $this->getDoctrine()->getManager();

      //repo  y entidad idiomas
      $repoIdiomas = $em->getRepository('AppBundle:Idioma');
      $idioma = $repoIdiomas->find($id);

      if ($idioma) {
          // eliminacion
          $em->remove($idioma);
          $em->flush();
          return new View("Eliminación satisfactoria", Response::HTTP_OK);
      } else {
          return new View('Película no encontrada', Response::HTTP_NOT_FOUND);
      }
  }


}
