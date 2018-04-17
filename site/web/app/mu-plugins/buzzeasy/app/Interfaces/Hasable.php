<?php

namespace Buzzeasy\App\Interfaces;

/**
 * Provides a contract that forces implementing classes to have the has()
 * method
 */
interface Hasable
{
    public function has() : bool;
}
