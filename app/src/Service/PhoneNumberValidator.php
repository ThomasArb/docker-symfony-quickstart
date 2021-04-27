<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class PhoneNumberValidator - Make API calls to validate information about a phone number.
 *
 * @package App\Service
 * @author Thomas ARBLAY
 */
class PhoneNumberValidator implements PhoneNumberValidatorInterface
{
    private const VALIDATION_PATH = '/validate';

    /** @var HttpClientInterface */
    private $client;

    /** @var string */
    private $uri;

    /**  @var string */
    private $userApi;

    /** @var string */
    private $password;

    public function __construct(
        HttpClientInterface $client,
        string $uri,
        string $userApi,
        string $password
    )
    {
        $this->client = $client;
        $this->uri = $uri;
        $this->userApi = $userApi;
        $this->password = $password;
    }

    /**
     * {@inheritdoc}
     */
    public function validate(string $phoneNumber, string $country): ?array
    {
        try {
            $response = $this->makeApiRequest($phoneNumber, $country);
            if ($response->getStatusCode() === Response::HTTP_OK) {
                $arrayContent = json_decode($response->getContent(), true);
                $result = array_shift($arrayContent);

                return $result['output'] ?? null;
            }

            return null;
        } catch (ExceptionInterface $exception) {
            return null;
        }
    }

    /**
     * Make a call to the api to validate the data.
     *
     * @param string $phoneNumber
     * @param string $country
     *
     * @return ResponseInterface
     *
     * @throws TransportExceptionInterface
     */
    protected function makeApiRequest(string $phoneNumber, string $country): ResponseInterface
    {
        return $this->client->request('POST', $this->uri . self::VALIDATION_PATH, [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($this->userApi . ':' . $this->password),
                'Content-Type' => 'application/json',
            ],
            'body' => '[{"phoneNumber": "' . $phoneNumber . '","countryCode": "' . $country . '"}]',
        ]);
    }
}
