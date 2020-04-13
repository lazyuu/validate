<?php

namespace Lazy\Validate;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lazy\LazyValidate\Skeleton\SkeletonClass
 */
class ValidateFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'lazy-validate';
    }
}
