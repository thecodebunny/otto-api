<?php

/**
 * Oauth2ApiAccessor File Doc Comment
 * php version 7.4.15
 * @link     https://public-docs.live.api.otto.market
 *
 */

namespace Thecodebunny\OttoApi\Oauth2;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Token\AccessTokenInterface;
use Thecodebunny\OttoApi\Configuration;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Oauth2ApiAccessor class simplifies handling of oauth2 tokens as used
 * by the OTTO-Market API
 * @link     https://public-docs.live.api.otto.market
 */
class Oauth2ApiAccessor
{
    private LoggerInterface $log;

    private AccessTokenInterface $accessToken;

    private Configuration $configuration;

    private Client $httpClient;

    /**
     * Construct a new Oauth2Api-Accessor.
     * If no Guzzle Client instance is provided, a new one will be generated with default settings.
     *
     * @param  Configuration   $configuration
     * @param  LoggerInterface $log
     * @param  Client          $httpClient
     * @throws Oauth2Exception if no valid initial token can be fetched
     */
    public function __construct(Configuration $configuration, LoggerInterface $log, Client $httpClient)
    {
        $this->log = $log;
        $this->log->debug("Setting up the Oauth2ApiAccessor");
        $this->configuration = $configuration;
        $this->httpClient    = $httpClient;
    }

    public function refreshToken($path, $headers) {
        $client = new Client();
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded',
            'Authorization' => 'Bearer '. $this->configuration->getDeveloperToken()
        ];
        $options = [
            'form_params' => [
                'scope' => 'products quantities orders'
            ]];
        $request = new Request('POST', 'https://api.otto.market/v1/apps/'. $this->configuration->getAppId() .'/installations/'
            . $this->configuration->getInstallationId() .'/accessToken', $headers);
        $res = $client->sendAsync($request, $options)->wait();
        $tokenRes = json_decode((string) $res->getBody());
        $this->configuration->setAccessToken($tokenRes->access_token);
        dump($this->configuration);
        $this->get($path, $headers);
    }

    /**
     * Make a synchronous GET call to an authenticated resource.
     * Token will be automatically fetched and updated, if required.
     *
     * @param  string $path    the path to access (relative to configured base URL)
     * @param  array  $headers headers to add to the request
     * @return ResponseInterface the response
     * @throws ClientExceptionInterface on HTTP client exception
     * @throws Oauth2Exception if an exception occurs on possible token refresh
     */
    public function get(string $path, array $headers = []): ResponseInterface
    {
        $url = $this->configuration->getApiBasePath() . $path;
        $this->log->debug("Making authenticated GET request to " . $url);

        $merged_headers = [
            'Authorization' => 'Bearer ' . $this->configuration->getAccessToken(),
            'User-Agent'    => $this->configuration->getUserAgent(),
        ];
        $merged_headers = array_merge($merged_headers, $headers);

        try {
            return $this->httpClient->get($url, ['headers' => $merged_headers]);
        } catch (ClientException $exception) {
            if ($exception->getCode() === 401) {
                $this->refreshToken($path, $headers);
            } elseif ($exception->getCode() == 429 || $exception->getCode() == 'QuotaExceeded') {
                sleep(60);
                $this->get($path, $headers);
            }
        }
    }

    /**
     * Make a synchronous POST call to an authenticated resource.
     * Token will be automatically fetched and updated, if required.
     *
     * @param  string $path    the path to access (relative to configured base URL)
     * @param  string $payload the payload to send
     * @param  array  $headers headers to add to the request
     * @return ResponseInterface the response
     * @throws ClientExceptionInterface on HTTP client exception
     * @throws Oauth2Exception if an exception occurs on possible token refresh
     */
    public function post(string $path, string $payload, array $headers = []): ResponseInterface
    {
        $url = $this->configuration->getApiBasePath() . $path;
        $this->log->debug("Making authenticated POST request to " . $url);
        $this->refreshToken();

        $merged_headers = [
            'Authorization' => 'Bearer ' . $this->configuration->getAccessToken(),
            'User-Agent'    => $this->configuration->getUserAgent(),
        ];
        $merged_headers = array_merge($merged_headers, $headers);

        return $this->httpClient->post($url, ['headers' => $merged_headers, 'body' => $payload]);
    }
}
