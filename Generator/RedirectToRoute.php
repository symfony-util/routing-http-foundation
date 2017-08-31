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

// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectToRoute // implements ControllerModelInterface
{
    // protected $response;

    public function __construct(Response $response = null)
    {
        // $this->response = $response;
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
