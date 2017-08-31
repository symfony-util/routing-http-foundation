<?php

/*
 * This file is part of the Symfony-Util package.
 *
 * (c) Jean-Bernard Addor
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollectionBuilder;
use SymfonyUtil\Component\RoutingHttpFoundation\Generator\RedirectToRoute;

// use SymfonyUtil\Component\HttpFoundation\ResponseParameters; // used in string use ::class in php 7.1 symfony 4.0 version

/**
 * @covers \SymfonyUtil\Component\RoutingHttpFoundation\Generator\RedirectToRoute
 */
final class RedirectToRouteTest extends TestCase
{
    public function testCanBeCreated()
    {
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'SymfonyUtil\Component\RoutingHttpFoundation\Generator\RedirectToRoute',
            new RedirectToRoute(new UrlGenerator(new RouteCollectionBuilder(), RequestContext()))
        );
    }

    public function testReturnsResponseParameters()
    {
        $routes = new RouteCollectionBuilder();
        $routes->add('/', '', 'index');
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'SymfonyUtil\Component\HttpFoundation\ResponseParameters',
            (new RedirectToRoute(new UrlGenerator($routes, RequestContext())))->__invoke('index')
        );
    }

    public function testRedirectResponseReturnsUrl()
    {
        $example = '/index';
        $routes = new RouteCollectionBuilder();
        $routes->add($example, '', 'index');
        $responseParameters = (new RedirectToRoute(new UrlGenerator($routes, RequestContext())))->__invoke('index');
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'SymfonyUtil\Component\HttpFoundation\ResponseParameters',
            $responseParameters
        );
        $response = $responseParameters->getResponse();
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'Symfony\Component\HttpFoundation\Response',
            $response
        );
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'Symfony\Component\HttpFoundation\RedirectResponse',
            $response
        );
        $url = $response->getTargetUrl();
        $this->assertInternalType('string', $url);
        $this->assertSame($example, $url);
    }
}
