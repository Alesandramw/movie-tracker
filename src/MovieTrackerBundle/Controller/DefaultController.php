<?php

namespace MovieTrackerBundle\Controller;

use MovieTrackerBundle\ORM\Model\Movie;
use MovieTrackerBundle\Form\Type\MovieType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('MovieTrackerBundle:default/Movies:index.html.twig');
    }

    /**
     * @Route("/view/{year}", name="year_movies")
     * @Template()
     */
    public function yearAction(Request $request)
    {

        $movies = $this->getDoctrine()->getManager()->getRepository('MovieTracker:Movie')->findAll();

        return array(
            'movies' => $movies
        );
    }
}
