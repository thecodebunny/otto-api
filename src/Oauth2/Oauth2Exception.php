<?php

/**
 * Oauth2Exception File Doc Comment
 * php version 7.4.15
 * @link     https://public-docs.live.api.otto.market
 *
 */

namespace Thecodebunny\OttoApi\Oauth2;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Thecodebunny\OttoApi\OttoMarketClientException;

/**
 * Oauth2Exception class shows errors regarding oauth2 workflows
 * @link     https://public-docs.live.api.otto.market
 */
class Oauth2Exception extends OttoMarketClientException
{
    public function __construct(IdentityProviderException $previous)
    {
        parent::__construct("Exception when attempting to fetch/update API token", 0, $previous);
    }
}
