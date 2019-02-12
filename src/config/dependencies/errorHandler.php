<?php
/**
 * Global settings for project configuration
 *
 * PHP Version 7.1
 *
 * @category  Dependency
 * @package   CorePHP_Slim_Scafold
 * @author    Eduardo Aguilar <dante.aguilar41@gmail.com>
 * @copyright 2018 Eduardo Aguilar
 * @license   https://github.com/danteay/corephp-slim-scafold/LICENSE Apache-2
 * @link      https://github.com/danteay/corephp-slim-scafold
 */

use Slim\Http\Request;
use Slim\Http\Response;

return function ($c) {
    return function (Request $req, Response $res, \Exception $err) use ($c) {
        $view = $c->get('renderer');

        $args['message'] = $err->getMessage();
        $args['trace'] = $err->getTraceAsString();
        $args['showTrace'] = $c['settings']['displayErrorDetails'];

        $logger = $c->get('logger');
        $logger->error($err->getMessage());
        $logger->error($err->getTraceAsString());

        return $view->render($res, 'errors/500.twig', $args);
    };
};
