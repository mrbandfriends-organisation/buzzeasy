<?php

return [
    \Buzzeasy\App\Modules\AjaxEndpoints::class => [
        \Buzzeasy\App\AjaxEndpoints\Post::class,
        \Buzzeasy\App\AjaxEndpoints\Page::class,
    ],

    \Buzzeasy\App\Modules\PostTypes::class => [
        \Buzzeasy\App\PostTypes\Example::class,
        \Buzzeasy\App\PostTypes\ConfigExample::class,
    ],
];
