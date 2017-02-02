<?php

use Lucandrade\Headers\Config;

class ConfigTest extends PHPUnit_Framework_TestCase
{

    protected $config;

    public function setUp()
    {
        parent::setUp();
        $this->mockConfig();
        $this->config = $this->loadConfig();
    }

    protected function loadConfig($type = 'add')
    {
        $config = Config::get();

        if (array_key_exists($type, $config)) {
            return $config[$type];
        }

        return $config;
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
        $this->assertTrue(array_key_exists('hsts', $this->config));
    }

    public function testShouldHaveContentSecurityPolicy()
    {
        $this->assertTrue(array_key_exists('csp', $this->config));
    }

    public function testShouldHaveXssProtection()
    {
        $this->assertTrue(array_key_exists('xss', $this->config));
    }

    public function testShouldHaveFrame()
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
        $this->config = $this->loadConfig('disabled');
        $this->assertTrue(array_key_exists('powered', $this->config));
    }
}
