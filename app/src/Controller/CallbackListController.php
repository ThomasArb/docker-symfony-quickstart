<?php

namespace App\Controller;

use App\Entity\CallbackRequest;
use App\Form\CallbackRequestType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class CallbackListController - Display the list of callback requests
 *
 * @package App\Controller
 * @author Thomas ARBLAY
 */
class CallbackListController
{
    /**
     * @var ObjectManager|null
     */
    private $entityManager;

    /**
     * @var Environment
     */
    private $twigEnvironment;

    /**
     * @param ManagerRegistry $registry
     * @param Environment $twigEnvironment
     */
    public function __construct(
        ManagerRegistry $registry,
        Environment $twigEnvironment
    )
    {
        $this->entityManager = $registry->getManagerForClass(CallbackRequest::class);
        $this->twigEnvironment = $twigEnvironment;
    }

    /**
     * Display all callbackRequests in a HTML table.
     *
     * @return Response
     *
     * @Route("/list", name="list_page")
     */
    public function __invoke(Request $request): Response
    {
        return new Response($this->twigEnvironment->render('list.html.twig', [
            'callbackRequests' => $this->entityManager->getRepository(CallbackRequest::class)->findAll(),
        ]));
    }
}
