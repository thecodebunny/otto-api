<?php

/**
 * Configuration File Doc Comment
 * php version 7.4.15
 * @link     https://hemangvyas.com
 *
 */

namespace Thecodebunny\OttoApi;

use App\Models\Otto\Settings;

/**
 * Configuration class stores configurable values used by all classes.
 * @link     https://hemangvyas.com
 */
class Configuration
{

    private string $accessToken;

    private string $developerToken;

    private string $appId;

    private string $instiallationId;

    private string $accessTokenUrl;

    private string $accessTokenClientId;

    private string $apiBasePath;

    private string $userAgent;

    private int $httpTimeout;

    /**
     * Configuration constructor.
     *
     * @param string $accessToken
     * @param string $developerToken
     * @param string $appId
     * @param string $installationId
     * @param string $accessTokenUrl
     * @param string $accessTokenClientId
     * @param string $apiBasePath
     * @param string $userAgent
     * @param int    $httpTimeout
     */
    private function __construct(
        string $accessToken,
        string $developerToken,
        string $appId,
        string $installationId,
        string $accessTokenUrl,
        string $accessTokenClientId,
        string $apiBasePath,
        string $userAgent,
        int $httpTimeout
    ) {
        $this->accessToken         = $accessToken;
        $this->developerToken      = $developerToken;
        $this->appId               = $appId;
        $this->installationId       = $installationId;
        $this->accessTokenUrl      = $accessTokenUrl;
        $this->accessTokenClientId = $accessTokenClientId;
        $this->apiBasePath         = $apiBasePath;
        $this->userAgent           = $userAgent;
        $this->httpTimeout         = $httpTimeout;
    }

    public static function forSandbox(string $accessToken, string $developerToken, string $appId, string $installationId): Configuration
    {
        return new Configuration(
            $accessToken,
            $developerToken,
            $appId,
            $installationId,
            "https://sandbox.api.otto.market/v1/token",
            "token-otto-api",
            "https://sandbox.api.otto.market",
            "marketplace-php-sdk",
            60
        );
    }

    public static function forLive(string $accessToken, string $developerToken, string $appId, string $installationId):
    Configuration
    {
        return new Configuration(
            $accessToken,
            $developerToken,
            $appId,
            $installationId,
            "https://api.otto.market/v1/token",
            "token-otto-api",
            "https://api.otto.market",
            "marketplace-php-sdk",
            60
        );
    }

    public function getAppId(): string
    {
        return $this->appId;
    }

    public function getInstallationId(): string
    {
        return $this->installationId;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function setAccessToken($accessToken)
    {
        $settings = Settings::first();
        $settings->installation_access_token = $accessToken;
        $settings->save();
        return $this->accessToken = $accessToken;
    }

    public function getDeveloperToken(): string
    {
        return $this->developerToken;
    }

    public function getAccessTokenUrl(): string
    {
        return $this->accessTokenUrl;
    }

    public function getAccessTokenClientId(): string
    {
        return $this->accessTokenClientId;
    }

    public function getApiBasePath(): string
    {
        return $this->apiBasePath;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function getHttpTimeout(): int
    {
        return $this->httpTimeout;
    }
}
