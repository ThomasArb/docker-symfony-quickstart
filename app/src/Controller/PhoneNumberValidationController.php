<?php

namespace App\Controller;

use App\Entity\CallbackRequest;
use App\Form\CallbackRequestType;
use App\Service\PhoneNumberValidator;
use App\Service\PhoneNumberValidatorInterface;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;

/**
 * Class PhoneNumberValidationController - Handle requests to validate phone numbers
 *
 * @package App\Controller
 * @author Thomas ARBLAY
 */
class PhoneNumberValidationController
{
    /**
     * Display the homepage of the site with the form to create a callback request.
     *
     * @return JsonResponse
     *
     * @Route("/validate_phone", name="validatePhone", methods={"POST"})
     */
    public function __invoke(
        Request $request,
        PhoneNumberValidatorInterface $phoneNumberValidator
    ): JsonResponse
    {
        $country = $request->request->get('country', '');
        $phoneNumber = $request->request->get('phoneNumber', '');
        if (
            $country === '' ||
            $phoneNumber === '' ||
            ($validationResult = $phoneNumberValidator->validate($phoneNumber,$country)) === null
        ) {
            return new JsonResponse(
                ['error' => 'Datas are missing or something went rong.'],
                Response::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse($validationResult);
    }
}
