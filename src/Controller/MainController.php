<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('main/index.html.twig');
    }

    /**
     * @Route("/about", name="aboutUs")
     */
    public function aboutUs(): Response
    {
        return $this->render('aboutUs.html.twig');
    }
}
