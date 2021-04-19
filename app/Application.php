<?php
namespace Cognitiven\Rest;

use Phalcon\Security;
use Phalcon\Mvc\Micro;
use Phalcon\Url as Uri;
use Phalcon\Mvc\View\Simple;
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as Database;
use Phalcon\Mvc\Model\Manager as ModelsManager;
use Phalcon\Mvc\Model\Metadata\Memory as ModelMetadata;

class Application {
    public $context;

    public function __construct() {
        $config = include __DIR__ . '/config/config.php';
        $di = $this->getDIContainer($config);

        $this->context = new Micro($di);
    }

    private function getDIContainer($config) {
        $di = new FactoryDefault();

        $di->set('url', function () use ($config) {
            $url = new Uri();
            $url->setBaseUri($config->application->baseUri);

            return $url;
        });

        $di->set('db', function () use ($config) {
            return new Database(
                [
                    "adapter" => "Mysql",
                    "host" => $config->database->host,
                    "username" => $config->database->username,
                    "password" => $config->database->password,
                    "dbname" => $config->database->name,
                    "charset" => "utf8",
                ]
            );
        }, true);

        $di->set("modelsMetadata", ModelMetadata::class);
        $di->set("modelsManager", ModelsManager::class);

        $di->set(
            'security',
            function () {
                $security = new Security();
                $security->setWorkFactor(12);

                return $security;
            },
            true
        );

        $di->set(
            'view',
            function () {
                $view = new Simple();
                $view->setViewsDir('../views/');

                return $view;
            }
        );

        return $di;
    }
}