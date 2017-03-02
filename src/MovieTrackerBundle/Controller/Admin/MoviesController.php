<?php

namespace MovieTrackerBundle\Controller\Admin;

use MovieTrackerBundle\ORM\Model\Movie;
use MovieTrackerBundle\Form\Type\MovieType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin/movies")
 */

class MoviesController extends Controller
{
    /**
     * @Route("/add", name="admin_add_movie")
     */
    public function addAction(Request $request)
    {
        $movie = new Movie();

        $movieForm = $this->createForm(MovieType::class, $movie);
        $movieForm->handleRequest($request);

        if ($movieForm->isSubmitted() && $movieForm->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($movie);
            $entityManager->flush();

        }

        return $this->render(
            'MovieTrackerBundle:Admin/Movies:add.html.twig',
            array(
                'movieForm' => $movieForm->createView()
            )
        );
    }
}
