<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    private $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }
    /**
     * @Route("/", name="login")
     */
    public function home(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        if($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            if($this->userRepository->findBy($user->getLogin)) {

            }
        }

        return $this->render('main/index.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/about", name="aboutUs")
     */
    public function aboutUs(): Response
    {
        return $this->render('aboutUs.html.twig');
    }
}
