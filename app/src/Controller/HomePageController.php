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
     * @var ObjectManager|null
     */
    private $entityManager;

    /**
     * @var Environment
     */
    private $twigEnvironment;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * @param ManagerRegistry $registry
     * @param Environment $twigEnvironment
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(
        ManagerRegistry $registry,
        Environment $twigEnvironment,
        FormFactoryInterface $formFactory,
        UrlGeneratorInterface $router
    )
    {
        $this->entityManager = $registry->getManagerForClass(CallbackRequest::class);
        $this->twigEnvironment = $twigEnvironment;
        $this->formFactory = $formFactory;
        $this->router = $router;
    }

    /**
     * Display the homepage of the site with the form to create a callback request.
     *
     * @return Response
     *
     * @Route("/", name="home_page")
     */
    public function __invoke(Request $request): Response
    {
        $callbackRequest = new CallbackRequest();
        $form = $this->formFactory->createBuilder(CallbackRequestType::class, $callbackRequest)->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $callbackRequest = $form->getData();
            $this->entityManager->persist($callbackRequest);
            $this->entityManager->flush();
            return new RedirectResponse($this->router->generate('success_page'));
        }
        return new Response($this->twigEnvironment->render('index.html.twig', [
            'form' => $form->createView(),
        ]));
    }
}
