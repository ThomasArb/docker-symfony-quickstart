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
     * Display the success message when a callback request is created.
     *
     * @param Environment $twigEnvironment
     *
     * @return Response
     *
     * @Route("/success", name="success_page")
     */
    public function __invoke(Environment $twigEnvironment): Response
    {
        return new Response($twigEnvironment->render('success.html.twig'));
    }
}
