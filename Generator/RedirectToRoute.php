<?php

/*
 * This file is part of the Symfony-Util package.
 *
 * (c) Jean-Bernard Addor
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SymfonyUtil\Component\RoutingHttpFoundation\Generator;
// Similar namespace in Symfony
// https://github.com/symfony/symfony/tree/v3.3.8/src/Symfony/Component/Routing/Generator

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;
use SymfonyUtil\Component\HttpFoundation\ResponseParameters;
use SymfonyUtil\Component\HttpFoundation\ControllerModel\ReRouteInterface;

class RedirectToRoute implements ReRouteControllerModelInterface
{
    protected $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    /**
     * 
     *
     * @param string $route         The name of the route
     * @param mixed  $parameters    An array of parameters
     *
     * @return 
     *
     * @see Interface
     */
    public function __invoke($route, $parameters = array())
    {
        return new ResponseParameters([], RedirectResponse($this->router->generate($route, $parameters)));
    }
}

// Inspired from https://github.com/symfony/symfony/blob/v3.3.8/src/Symfony/Bundle/FrameworkBundle/Controller/ControllerTrait.php
