<?php

use Phalcon\Mvc\Micro;

$app = new Micro();

$app->get(
    '/api/robots',
    function () {

    }
);

$app->handle();