<?php

namespace Buzzeasy\App\Utilities;

class SiteOptions extends Post
{
    /**
     * @param int $id - id of the post to get properties for
     */
    public function __construct()
    {
        $this->id = 'options';
    }
}

