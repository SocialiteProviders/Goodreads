<?php

namespace SocialiteProviders\Goodreads;

use SocialiteProviders\Manager\OAuth1\AbstractProvider;
use SocialiteProviders\Manager\OAuth1\User;

class Provider extends AbstractProvider
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'GOODREADS';

    /**
     * {@inheritdoc}
     */
    public function user()
    {
        $user = $this->server->getUserDetails($token = $this->getToken());

        return (new User())->setRaw($user->extra)->map([
            'id' => $user->id, 'nickname' => null, 'name' => $user->name,
            'email' => null, 'avatar' => null,
        ])->setToken($token->getIdentifier(), $token->getSecret());
    }
}
