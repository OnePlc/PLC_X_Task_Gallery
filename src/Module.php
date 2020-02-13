<?php
/**
 * Module.php - Module Class
 *
 * Module Class File for Task Gallery Plugin
 *
 * @category Config
 * @package Task\Gallery
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

namespace OnePlace\Task\Gallery;

use Application\Controller\CoreEntityController;
use Laminas\Mvc\MvcEvent;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\EventManager\EventInterface as Event;
use Laminas\ModuleManager\ModuleManager;
use OnePlace\Task\Model\TaskTable;
use OnePlace\Task\Gallery\Controller\GalleryController;

class Module {
    /**
     * Module Version
     *
     * @since 1.0.0
     */
    const VERSION = '1.0.1';

    /**
     * Load module config file
     *
     * @since 1.0.0
     * @return array
     */
    public function getConfig() : array {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(Event $e)
    {
        // This method is called once the MVC bootstrapping is complete
        $application = $e->getApplication();
        $container    = $application->getServiceManager();
        $oDbAdapter = $container->get(AdapterInterface::class);
        $tableGateway = $container->get(GalleryTable::class);

        # Register Filter Plugin Hook
    }

    /**
     * Load Models
     */

    /**
     * Load Controllers
     */
    public function getControllerConfig() : array {
        return [
            'factories' => [
                # Installer
                Controller\InstallController::class => function($container) {
                    $oDbAdapter = $container->get(AdapterInterface::class);
                    return new Controller\InstallController(
                        $oDbAdapter,
                        $container->get(Model\GalleryTable::class),
                        $container
                    );
                },
            ],
        ];
    } # getControllerConfig()
}
