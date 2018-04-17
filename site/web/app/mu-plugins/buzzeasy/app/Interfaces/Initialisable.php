<?php

namespace Buzzeasy\App\Interfaces;

/**
 * Provides a contract that forces implementing classes to have the initialise()
 * method
 *
 */
interface Initialisable
{
    public static function initialise();
}
