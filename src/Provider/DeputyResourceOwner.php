<?php
namespace Cartertech\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class DeputyResourceOwner implements ResourceOwnerInterface
{
    /**
     * @var array
     */
    protected $response;

    /**
     * @var string
     */
    protected $resourceOwnerId;

    /**
     * @param array $response
     * @param string $resourceOwnerId
     */
    public function __construct(array $response, $resourceOwnerId)
    {
        $this->response = $response;
        $this->resourceOwnerId = $resourceOwnerId;
    }

    /**
     * Returns the identifier of the authorized resource owner.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->response[$this->resourceOwnerId];
    }
    
    /**
     * Returns the login of the resource owner.
     * @return string|null
     */
    public function getLogin()
    {
        return $this->response['Login'] ?: null;        
    }
    /**
     * Returns the lastname of the resource owner.
     * @return string|null
     */
    public function getLastName()
    {
        return $this->response['LastName'] ?: null;
    }
    
    /**
     * Returns the first name of the resource owner.
     * @return string|null
     */    
    public function getFirstName()
    {
        return $this->response['FirstName'] ?: null;
    }
	
	 /**
     * Returns the name of the resource owner.
     * @return string|null
     */    
    public function getName()
    {
		if ($this->response['FirstName'] && $this->response['LastName'])
		{
			return $this->response['FirstName']." ".$this->response['LastName'];
		}
		else
		{
			return null;
		}
    }
    
    /**
     * Return the email of the resource owner.
     * @return string|null
     */
    public function getEmail()
    {
        return $this->response['PrimaryEmail'] ?: null;
    }
    
    /**
     * Return the phone number of the resource owner.
     * @return string|null
     */
    public function getPhone()
    {
        return $this->response['PrimaryPhone'] ?: null;
    }
    
    /**
     * Return the URL to the photo of the resource owner.
     * @return string|null
     */
    public function getPhotoUrl()
    {
        return $this->response['UserObjectforAPI']['Photo'] ?: null;
    }
    
    /**
     * Return the permissions object for the resource owner.
     * @return string|null
     */
    public function getPermissions()
    {
        return $this->response['Permissions'] ?: null;
    }

    /**
     * Returns the raw resource owner response.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->response;
    }
}
