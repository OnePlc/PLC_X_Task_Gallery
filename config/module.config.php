<?php
/**
 * module.config.php - Gallery Config
 *
 * Main Config File for Task Gallery Plugin
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

use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    # Gallery Module - Routes
    'router' => [
        'routes' => [
            'task-gallery-setup' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/task/gallery/setup',
                    'defaults' => [
                        'controller' => Controller\InstallController::class,
                        'action'     => 'checkdb',
                    ],
                ],
            ],
        ],
    ], # Routes

    # View Settings
    'view_manager' => [
        'template_path_stack' => [
            'task-gallery' => __DIR__ . '/../view',
        ],
    ],
];
