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
     * @Route("/year/{year}", name="public_by_year")
     * @Route("/", name="public_home")
     * @Template()
     */
    public function homeAction(Request $request, $year = '')
    {
        if ($year != '')
        {
            $movies = $this->getDoctrine()->getManager()->createQuery(sprintf("SELECT m FROM MovieTracker:Movie m WHERE m.date >= '%d-01-01' AND m.date <= '%d-12-31'", $year, $year))->getResult();
        }
        else
        {
            $movies = $this->getDoctrine()->getManager()->getRepository('MovieTracker:Movie')->findBy(array(), array('date' => 'DESC'));
        }

        return array(
            'movies' => $movies
        );
    }
}
