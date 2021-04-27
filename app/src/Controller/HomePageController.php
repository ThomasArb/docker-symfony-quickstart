<?php

namespace App\Controller;

use App\Entity\CallbackRequest;
use App\Form\CallbackRequestType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class HomePageController - Display the main page with a form
 *
 * @package App\Controller
 * @author Thomas ARBLAY
 */
class HomePageController
{
    /**
     * Display the homepage of the site with the form to create a callback request.
     *
     * @param Request               $request
     * @param ManagerRegistry       $registry
     * @param Environment           $twigEnvironment
     * @param FormFactoryInterface  $formFactory
     * @param UrlGeneratorInterface $router
     *
     * @return Response
     *
     * @Route("/", name="home_page")
     */
    public function __invoke(
        Request $request,
        ManagerRegistry $registry,
        Environment $twigEnvironment,
        FormFactoryInterface $formFactory,
        UrlGeneratorInterface $router
    ): Response
    {
        $callbackRequest = new CallbackRequest();
        $form = $formFactory->createBuilder(CallbackRequestType::class, $callbackRequest)->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $callbackRequest = $form->getData();
            $entityManager = $registry->getManagerForClass(CallbackRequest::class);
            $entityManager->persist($callbackRequest);
            $entityManager->flush();
            return new RedirectResponse($router->generate('success_page'));
        }
        return new Response($twigEnvironment->render('index.html.twig', [
            'form' => $form->createView(),
        ]));
    }
}
