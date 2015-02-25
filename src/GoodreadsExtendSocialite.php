<?php
namespace SocialiteProviders\Goodreads;

use SocialiteProviders\Manager\SocialiteWasCalled;

class GoodreadsExtendSocialite
{
    /**
     * Execute the provider.
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite(
            'goodreads', __NAMESPACE__.'\Provider', __NAMESPACE__.'\Server'
        );
    }
}
