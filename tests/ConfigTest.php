<?php

use Lucandrade\SecureHeaders\Config;

class ConfigTest extends PHPUnit_Framework_TestCase
{

    protected $config;

    public function setUp()
    {
        parent::setUp();
        $this->mockConfig();
        $this->config = $this->loadConfig();
    }

    protected function loadConfig()
    {
        return Config::get();
    }

    protected function mockConfig($return = false)
    {
        if (!function_exists('config')) {
            function config() {
                return $return;
            }
        }
    }

    public function testShouldHaveStrictTransport()
    {
        $this->assertTrue(array_key_exists('sts', $this->config));
    }

    public function testShouldHaveContentSecurityPolicy()
    {
        $this->assertTrue(array_key_exists('csp', $this->config));
    }

    public function testShouldHaveXssProtection()
    {
        $this->assertTrue(array_key_exists('xss', $this->config));
    }

    public function testShouldHaveFrameOptions()
    {
        $this->assertTrue(array_key_exists('frame', $this->config));
    }

    public function testShouldHaveNoSniff()
    {
        $this->assertTrue(array_key_exists('nosniff', $this->config));
    }

    public function testShouldHaveDnsPrefetch()
    {
        $this->assertTrue(array_key_exists('dns', $this->config));
    }

    public function testShouldHaveHidePoweredBy()
    {
        $this->assertTrue(array_key_exists('poweredby', $this->config));
    }

    public function testShouldHaveServer()
    {
        $this->assertTrue(array_key_exists('server', $this->config));
    }
}
