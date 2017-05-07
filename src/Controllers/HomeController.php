<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function index()
    {
        return $this->app['twig']->render('welcome.twig', [
            'welcome' => 'Welcome to Arango Book Store!'
        ]);
    }
}
