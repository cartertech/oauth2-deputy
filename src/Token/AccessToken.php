<?php

namespace Cartertech\OAuth2\Client\Token;

class AccessToken extends \League\OAuth2\Client\Token\AccessToken
{
    /**
     * Deputy Endpoint URL
     *
     * @var string
     */
    private $endpointUrl;

    /**
     * Constructs an access token.
     *
     * @param array $options An array of options returned by the service provider
     *     in the access token request. The `access_token` option is required.
     */
    public function __construct(array $options)
    {
        parent::__construct($options);

        $this->endpointUrl = $options['endpoint'];
    }

    /**
     * Returns Deputy Endpoint URL related to Access Token
     *
     * @return string
     */
    public function getEndpointUrl()
    {
        return $this->endpointUrl;
    }
    
    public function getResourceOwnerDetailsUrl()
    {
        return "https://".$this->endpointUrl."/api/v1/me";
    }
}
