<?php

namespace App\Controller;

use App\Entity\Truc;
use App\Form\TrucType;
use App\Repository\TrucRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/wish", name="wish_")
 */
class TrucController extends AbstractController
{

    private $trucRepository;

    public function __construct(TrucRepository $trucRepository){
        $this->trucRepository = $trucRepository;
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(): Response
    {
        return $this->render('wish/create.html.twig', [
            'controller_name' => 'TrucController',
        ]);
    }

    /**
     * @Route("/", name="list")
     */
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = new Truc();
        $wishes = $this->trucRepository->findAll();

        $form = $this->createForm(TrucType::class, $task);
        if(!$wishes){
            throw  $this->createNotFoundException(('No wishes found'));
        }

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($task);
            $entityManager->flush($task);

            return $this->redirectToRoute('wish_list');
        }


        return $this->render('wish/index.html.twig', [
            'wishes' => $wishes,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/detail/{id}", name="detail_id")
     */
    public function detail($id): Response
    {
        $wish = $this->trucRepository->find($id);

        return $this->render('wish/detail.html.twig', [
            'controller_name' => 'TrucController',
            'wish' => $wish,
        ]);
    }

    /**
     * @Route("/detail/{id}/validate", name="detail_id_validate")
     */
    public function validate($id, EntityManagerInterface $entityManager): Response
    {
        $wish = $this->trucRepository->find($id);
        $wish->setStatut(true);
        $entityManager->persist($wish);
        $entityManager->flush($wish);

        return $this->render('wish/detail.html.twig', [
            'controller_name' => 'TrucController',
            'wish' => $wish,
        ]);
    }
}
