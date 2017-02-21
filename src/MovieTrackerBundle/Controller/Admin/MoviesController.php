<?php

namespace MovieTrackerBundle\Controller\Admin;

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
        return $this->render('MovieTrackerBundle:Admin/Movies:add.html.twig');
    }
}
