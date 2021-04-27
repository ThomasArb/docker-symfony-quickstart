<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

/**
 * Class SuccessPageController - Display the success page
 *
 * @package App\Controller
 * @author Thomas ARBLAY
 */
class SuccessPageController
{
    /**
     * @var Environment
     */
    private $twigEnvironment;

    /**
     * @param Environment $twigEnvironment
     */
    public function __construct(
        Environment $twigEnvironment
    )
    {
        $this->twigEnvironment = $twigEnvironment;
    }

    /**
     * Display the success message when a callback request is created.
     *
     * @return Response
     *
     * @Route("/success", name="success_page")
     */
    public function __invoke(Request $request): Response
    {
        return new Response($this->twigEnvironment->render('success.html.twig'));
    }
}
