<?php

namespace App\Controller;

use App\Entity\Truc;
use App\Form\TrucType;
use App\Helper\CensuratorService;
use App\Repository\CategoryRepository;
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
    private $categoryRepository;

    public function __construct(TrucRepository $trucRepository, CategoryRepository $categoryRepository){
        $this->trucRepository = $trucRepository;
        $this->categoryRepository = $categoryRepository;
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
    public function index(Request $request, EntityManagerInterface $entityManager, CensuratorService $censuratorService): Response
    {
        $categories = $this->categoryRepository->findAll();
        $task = new Truc();
        $wishes = $this->trucRepository->findBy(['user'=>$this->getUser()]);

        $form = $this->createForm(TrucType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task->setLibelle($censuratorService->purify($task->getLibelle()));

            $entityManager->persist($task);
            $entityManager->flush($task);

            return $this->redirectToRoute('wish_list');
        }

        return $this->render('wish/index.html.twig', [
            'wishes' => $wishes,
            'categories' => $categories,
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

        return $this->redirectToRoute('wish_list');
    }

    /**
     * @Route("/detail/{id}/unvalidate", name="detail_id_unvalidate")
     */
    public function unvalidate($id, EntityManagerInterface $entityManager): Response
    {
        $wish = $this->trucRepository->find($id);
        $wish->setStatut(false);
        $entityManager->persist($wish);
        $entityManager->flush($wish);

        return $this->redirectToRoute('wish_list');
    }
}
