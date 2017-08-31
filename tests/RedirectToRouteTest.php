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
            new RedirectToRoute()
        );
    }

    public function testReturnsResponseParameters()
    {
        $this->assertInstanceOf(
            // ::class, // 5.4 < php
            'SymfonyUtil\Component\HttpFoundation\ResponseParameters',
            (new RedirectToRoute())->__invoke('index')
        );
    }

    public function testRedirectResponseReturnsUrl()
    {
        $example = 'http://example.org/';
        $responseParameters = (new NullControllerModel(new RedirectResponse($example)))->__invoke();
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
        $url = $response->getTargetUrl();
        $this->assertInternalType('string', $url);
        $this->assertSame($example, $url);
    }
}
