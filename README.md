# Deputy Provider for OAuth 2.0 Client

[![Latest Version](https://img.shields.io/github/release/cartertech/oauth2-deputy.svg?style=flat-square)](https://github.com/cartertech/oauth2-deputy/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/cartertech/oauth2-deputy/master.svg?style=flat-square)](https://travis-ci.org/cartertech/oauth2-deputy)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/cartertech/oauth2-deputy.svg?style=flat-square)](https://scrutinizer-ci.com/g/cartertech/oauth2-deputy/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/cartertech/oauth2-deputy.svg?style=flat-square)](https://scrutinizer-ci.com/g/cartertech/oauth2-deputy)
[![Total Downloads](https://img.shields.io/packagist/dt/cartertech/oauth2-deputy.svg?style=flat-square)](https://packagist.org/packages/cartertech/oauth2-deputy)

This package provides Deputy OAuth 2.0 support for the PHP League's [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client).

## Usage

Usage is similar to The League's OAuth client, using `\Cartertech\OAuth2\Client\Provider\Deputy` as the provider.

### Authorization Code Flow

```php
$provider = new Cartertech\OAuth2\Client\Provider\Deputy([
    'clientId'                => <your_client_id>,    // The client ID assigned to you by the provider
    'clientSecret'            => <your_client_secret>,    // The client password assigned to you by the provider
    'redirectUri'             => 'https://example.com/callback.php,
    'urlAuthorize'            => 'https://once.deputy.com/my/oauth/login',
    'urlAccessToken'          => 'https://once.deputy.com/my/oauth/access_token'
]);

```
For further usage of this package please refer to the [core package documentation on "Authorization Code Grant"](https://github.com/thephpleague/oauth2-client#usage).

### Refreshing a Token

```php
$existingAccessToken = getAccessTokenFromYourDataStore();

if ($existingAccessToken->hasExpired()) {
    $newAccessToken = $provider->getAccessToken('refresh_token', [
        'refresh_token' => $existingAccessToken->getRefreshToken()
    ]);

    // Purge old access token and store new access token to your data store.
}
```

### Storing the endpoint URL for the Provider's use

```php
$provider->setDomain($accessToken->getEndpointUrl());
```

For further usage of this package please refer to the [core package documentation on "Refreshing a Token"](https://github.com/thephpleague/oauth2-client#refreshing-a-token).

## Credits

- [Carter Tech Pty Ltd](https://github.com/cartertech)
- [All Contributors](https://github.com/cartertech/oauth2-deputy/contributors)


## License

The MIT License (MIT). Please see [License File](https://github.com/cartertech/oauth2-deputy/blob/master/LICENSE) for more information.
