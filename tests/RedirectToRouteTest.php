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
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RouteCollectionBuilder;
use SymfonyUtil\Component\RoutingHttpFoundation\Generator\RedirectToRoute;

// used in string use ::class in php 7.1 symfony 4.0 version
// use Symfony\Component\HttpFoundation\RedirectResponse;
// use Symfony\Component\HttpFoundation\Response;
// use SymfonyUtil\Component\HttpFoundation\ResponseParameters;

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
            new RedirectToRoute(new UrlGenerator(new RouteCollection(), new RequestContext()))
        );
    }

    public function testCanBeCreatedAsInterface()
    {
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'SymfonyUtil\Component\HttpFoundation\ReRouteInterface',
            new RedirectToRoute(new UrlGenerator(new RouteCollection(), new RequestContext()))
        );
    }

    public function testReturnsResponse()
    {
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'Symfony\Component\HttpFoundation\Response',
            (new RedirectToRoute(new UrlGenerator(
                (new RouteCollectionBuilder())->addRoute(new Route('/'), 'index')->build(),
                new RequestContext()
            )))->__invoke('index')
        );
    }

    public function testRedirectResponseReturnsUrl()
    {
        $example = '/index';
        $response = (new RedirectToRoute(new UrlGenerator(
            (new RouteCollectionBuilder())->addRoute(new Route($example), 'index')->build(),
            new RequestContext()
        )))->__invoke('index');
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
