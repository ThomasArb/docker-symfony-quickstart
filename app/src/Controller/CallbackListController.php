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
     * Display all callbackRequests in a HTML table.
     *
     * @param ManagerRegistry $registry
     * @param Environment     $twigEnvironment
     *
     * @return Response
     *
     * @Route("/list", name="list_page")
     */
    public function __invoke(
        ManagerRegistry $registry,
        Environment $twigEnvironment
    ): Response
    {
        return new Response($twigEnvironment->render('list.html.twig', [
            'callbackRequests' => $registry->getManagerForClass(CallbackRequest::class)
                                            ->getRepository(CallbackRequest::class)
                                            ->findAll(),
        ]));
    }
}
