<?php

use Lucandrade\Headers\Config;
use Lucandrade\Headers\Bag;

class BagTest extends PHPUnit_Framework_TestCase
{

    protected $class;

    public function setUp()
    {
        parent::setUp();
        $this->mockConfig();
        $config = Config::get();
        $this->class = new Bag($config);
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
        $this->assertTrue(array_key_exists('Strict-Transport-Security', $this->class->get()));
        $this->assertTrue(!empty($this->class->get()['Strict-Transport-Security']));
    }

    public function testShouldHaveContentSecurityPolicy()
    {
        $this->assertTrue(array_key_exists('Content-Security-Policy', $this->class->get()));
        $this->assertTrue(!empty($this->class->get()['Content-Security-Policy']));
    }

    public function testShouldHaveXssProtection()
    {
        $this->assertTrue(array_key_exists('X-XSS-Protection', $this->class->get()));
        $this->assertTrue(!empty($this->class->get()['X-XSS-Protection']));
    }

    public function testShouldHaveFrameOptions()
    {
        $this->assertTrue(array_key_exists('X-Frame-Options', $this->class->get()));
        $this->assertTrue(!empty($this->class->get()['X-Frame-Options']));
    }

    public function testShouldHaveNoSniff()
    {
        $this->assertTrue(array_key_exists('X-Content-Type-Options', $this->class->get()));
        $this->assertTrue(!empty($this->class->get()['X-Content-Type-Options']));
    }

    public function testShouldHaveDnsPrefetch()
    {
        $this->assertTrue(array_key_exists('X-DNS-Prefetch-Control', $this->class->get()));
        $this->assertTrue(!empty($this->class->get()['X-DNS-Prefetch-Control']));
    }

    public function testShouldDisableHidePoweredBy()
    {
        $this->assertTrue(in_array('x-powered-by', $this->class->disabled()));
    }

    public function testShouldNotHaveStrictTransport()
    {
        $header = 'Strict-Transport-Security';
        $this->class->remove($header);
        $this->assertFalse(array_key_exists($header, $this->class->get()));
    }

    public function testShouldNotDisableHidePoweredBy()
    {
        $header = 'x-powered-by';
        $this->class->disable($header);
        $this->assertTrue(in_array($header, $this->class->disabled()));
        $this->assertFalse(array_key_exists($header, $this->class->get()));
    }
}
