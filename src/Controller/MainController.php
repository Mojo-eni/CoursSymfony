<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('main/index.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,]);
    }

    /**
     * @Route("/about", name="aboutUs")
     */
    public function aboutUs(): Response
    {
        return $this->render('aboutUs.html.twig');
    }
}
