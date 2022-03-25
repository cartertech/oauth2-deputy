<?php
/**
 * This file is part of the cartertech/oauth2-deputy library
 * 
 * This file requires league/oauth2-client library @see http://thephpleague.com/oauth2-client/Documentation
 * 
 * @copyright Copyright (c) Carter Tech Pty Ltd <oss@carter-tech.com.au>
 * 
 * @license http://opensource.org/licenses/MIT MIT
 * 
 * @link https://github.com/thephpleague/oauth2-client GitHub
 */
namespace Cartertech\OAuth2\Client\Provider;

use Exception;
use InvalidArgumentException;
use League\OAuth2\Client\Grant\AbstractGrant;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Token\AccessToken;
use Psr\Http\Message\ResponseInterface;

class Deputy extends AbstractProvider
{
    /**
     * @var string Key used in a token response to identify the resource owner.
     */
    const ACCESS_TOKEN_RESOURCE_OWNER_ID = 'UserId';

    /**
     * Base domain used for authentication
     *
     * @var string
     */
    protected $domain = 'https://once.deputy.com';

    /**
     * Get authorization url to begin OAuth flow
     *
     * @return string
     */
    public function getBaseAuthorizationUrl()
    {
        return $this->domain . '/my/oauth/login';
    }

    /**
     * Get access token url to retrieve token
     *
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params)
    {    
        if (strcmp($params['grant_type'],"refresh_token") == 0)
        {
            return $this->domain.'/oauth/access_token';
            
        }
        return $this->domain . '/my/oauth/access_token';
    }

    /**
     * Get provider url to fetch user details
     *
     * @param  AccessToken $token
     *
     * @return string
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return $token->getResourceOwnerDetailsUrl();
    }

    /**
     * Get the default scopes used by this provider.
     *
     * This should not be a complete list of all scopes, but the minimum
     * required for the provider user interface!
     *
     * @return array
     */
    protected function getDefaultScopes()
    {
        return [];
    }

    /**
     * Retrives the currently configured provider domain.
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Returns the string that should be used to separate scopes when building
     * the URL for requesting an access token.
     *
     * @return string Scope separator, defaults to ','
     */
    protected function getScopeSeparator()
    {
        return ' ';
    }
    
    /**
     * Returns the URL for fetching Resource Owner details
     * @return string
     */
    
    public function getUrlResourceOwnerDetails()
    {
        return $this->urlResourceOwnerDetails;
    }
    
    /**
     * Returns the authorization headers used by this provider.
     *
     * @param  mixed|null $token Either a string or an access token instance
     * @return string
     */
    
    protected function getAuthorizationHeaders($token = null)
    {
        return ['Authorization' => 'OAuth ' . $token];
    }

    /**
     * Check a provider response for errors.
     *
     * @throws IdentityProviderException
     * @param  ResponseInterface $response
     * @param  string $data Parsed response data
     * @return void
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        $statusCode = $response->getStatusCode();
        if ($statusCode >= 400) {
            throw new IdentityProviderException(
                isset($data[0]['message']) ? $data[0]['message'] : $response->getReasonPhrase(),
                $statusCode,
                $response
            );
        }
    }

    /**
     * Generate a user object from a successful user details request.
     *
     * @param object $response
     * @param AccessToken $token
     * @return DeputyResourceOwner
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        return new DeputyResourceOwner($response,'UserId');
    }

    /**
     * Creates an access token from a response.
     *
     * The grant that was used to fetch the response can be used to provide
     * additional context.
     *
     * @param  array $response
     * @param  AbstractGrant $grant
     * @return AccessToken
     */
    protected function createAccessToken(array $response, AbstractGrant $grant)
    {
        return new \Cartertech\OAuth2\Client\Token\AccessToken($response);
    }

    /**
     * Updates the provider domain with a given value.
     *
     * @throws  InvalidArgumentException
     * @param string $domain
     * @return  Deputy
     */
    public function setDomain($domain)
    {
        try {
            $this->domain = (string) $domain;
        } catch (Exception $e) {
            throw new InvalidArgumentException(
                'Value provided as domain is not a string'
            );
        }

        return $this;
    }
    
    
}
