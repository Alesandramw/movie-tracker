<?php

namespace MovieTrackerBundle\Controller\Admin;

use MovieTrackerBundle\ORM\Model\Movie;
use MovieTrackerBundle\Form\Type\MovieType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
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
            $this->addFlash('notice', sprintf('The movie %s has been added.', $movie->getTitle()));
            return $this->redirectToRoute('admin_manage_movies');

        }

        return $this->render(
            'MovieTrackerBundle:Admin/Movies:add.html.twig',
            array(
                'movieForm' => $movieForm->createView()
            )
        );
    }

    /**
     * @Route("/manage", name="admin_manage_movies")
     * @Template()
     */
    public function manageAction(Request $request)
    {
        $movies = $this->getDoctrine()->getManager()->getRepository('MovieTracker:Movie')->findAll();

        return array(
            'movies' => $movies
        );
    }

    /**
     * @Route("/view/{movie_id}", name="admin_view_movie")
     * @ParamConverter("movie", class="MovieTracker:Movie", options={"id"="movie_id"})
     * @Template()
     */
    public function viewAction(Request $request, Movie $movie)
    {
        $movieForm = $this->createForm(MovieType::class, $movie);

        $movieForm->handleRequest($request);

        // if we are deleting the page
        if ($movieForm->isSubmitted() && $movieForm->has('delete') && $movieForm->get('delete')->isClicked()) {

            $movieTitle = $movie->getTitle();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->remove($movie);
            $entityManager->flush();

            $this->addFlash('notice', sprintf('The movie %s has been removed.', $movieTitle));

            return $this->redirectToRoute('admin_manage_movies');

        }

        if ($movieForm->isSubmitted() && $movieForm->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();
            $this->addFlash('notice', sprintf('The movie %s has been updated.', $movie->getTitle()));

        }

        return array(
            'movieForm' => $movieForm->createView()
        );
    }

    /**
     * @Route("/delete/{movie_id}", name="admin_delete_movie")
     * @ParamConverter("movie", class="MovieTracker:Movie", options={"id"="movie_id"})
     * @Template()
     */
    public function deleteAction(Movie $movie)
    {

        $entityManager = $this->getDoctrine()->getEntityManager();
        //$entities = $entityManager->getRepository('MovieTracker:Movie')->find($movie);

        $entityManager->remove($movie);
        $entityManager->flush();

        $this->addFlash('notice', sprintf('The movie %s has been removed.', $movie->getTitle()));
            return $this->redirectToRoute('admin_manage_movies');
    }
}
