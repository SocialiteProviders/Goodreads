<?php
namespace SocialiteProviders\Goodreads;

use Laravel\Socialite\One\AbstractProvider;
use Laravel\Socialite\One\User;

class Provider extends AbstractProvider
{
    /**
     * {@inheritDoc}
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
