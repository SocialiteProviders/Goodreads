<?php
namespace SocialiteProviders\Goodreads;

use Laravel\Socialite\One\User;
use League\OAuth1\Client\Credentials\CredentialsException;
use League\OAuth1\Client\Credentials\TemporaryCredentials;
use League\OAuth1\Client\Credentials\TokenCredentials;
use League\OAuth1\Client\Server\Server as BaseServer;

class Server extends BaseServer
{
    /**
     * The response type for data returned from API calls.
     *
     * @var string
     */
    protected $responseType = 'xml';

    /**
     * {@inheritDoc}
     */
    public function urlTemporaryCredentials()
    {
        return 'http://www.goodreads.com/oauth/request_token';
    }

    /**
     * {@inheritDoc}
     */
    public function urlAuthorization()
    {
        return ' https://www.goodreads.com/oauth/authorize';
    }

    /**
     * {@inheritDoc}
     */
    public function urlTokenCredentials()
    {
        return 'http://www.goodreads.com/oauth/access_token';
    }

    /**
     * {@inheritDoc}
     */
    public function urlUserDetails()
    {
        return 'http://www.goodreads.com/api/auth_user';
    }

    /**
     * {@inheritDoc}
     */
    public function userDetails($data, TokenCredentials $tokenCredentials)
    {
        $user        = new User();
        $user->id    = (int) $data->user->attributes()->id;
        $user->name  = (string) $data->user->name;
        $user->extra = json_decode(json_encode($data), true);

        return $user;
    }

    /**
     * {@inheritDoc}
     */
    public function userUid($data, TokenCredentials $tokenCredentials)
    {
        return (int) $data->user->attributes()->id;
    }

    /**
     * {@inheritDoc}
     */
    public function userEmail($data, TokenCredentials $tokenCredentials)
    {
        return;
    }

    /**
     * {@inheritDoc}
     */
    public function userScreenName($data, TokenCredentials $tokenCredentials)
    {
        return;
    }

    /**
     * {@inheritDoc}
     */
    protected function createTemporaryCredentials($body)
    {
        parse_str($body, $data);

        if (!$data || !is_array($data)) {
            throw new CredentialsException("Unable to parse temporary credentials response.");
        }

        $temporaryCredentials = new TemporaryCredentials();
        $temporaryCredentials->setIdentifier($data['oauth_token']);
        $temporaryCredentials->setSecret($data['oauth_token_secret']);

        return $temporaryCredentials;
    }
}
