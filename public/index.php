<?php

use Phalcon\Mvc\Micro;
use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;

$loader = new Loader();

$loader->registerNamespaces(
    [
        'Store\Toys' => __DIR__ . '/models/',
    ]
);

$loader->register();

$di = new FactoryDefault();

$di->set(
    'db',
    function () {
        return new PdoMysql(
            [
                'host'      => 'localhost',
                'username'  => 'root',
                'password'  => 'root',
                'dbname'    => 'phalcon_rest',
            ]
        )
    }
)


$app = new Micro($di);

$app->get(
    '/api/robots',
    function () use ($app) {
        $phql = 'SELECT * FROM Store\Toys\Robots ORDER BY name';

        $robots = $app->modelManager->executeQuery($phql);

        $data = [];

        foreach ($robots as $robot) {
            $data[] = [
                'id'    => $robot->id,
                'name'  => $robot->name,
            ];
        }

        echo json_encode($data);
    }
);

$app->get(
    '/api/robots/search/{name>}',
    function ($name) {

    }
);

$app->get(
    '/api/robots/{id:[0-9]+',
    function ($id) {

    }
);

$app->post(
    '/api/robots/',
    function () {

    }
);

$app->put(
    '/api/robots/{id:[0-9]+}',
    function ($id) {

    }
);

$app->delete(
    '/api/robots/{id:[0-9]+}',
    function ($id) {

    }
);

$app->handle();