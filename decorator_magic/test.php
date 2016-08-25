<?php
require_once 'Object.php';
require_once 'Decorator.php';
use Blog\Decorator;
use Blog\Object;
class DecoratorTest extends PHPUnit_Framework_TestCase
{
    public function testOriginalRender()
    {
        $origin = new Object();
        $origin->setId(666);
        $this->assertEquals('id = 666', $origin->render());
    }
    public function testProxySetGet()
    {
        $origin = new Object();
        $decorator = new Decorator($origin);
        $this->assertNotEquals(777, $decorator->getId());
        $decorator->setId(777);
        $this->assertEquals(777, $decorator->getId());
    }
    public function testOverridingRender()
    {
        $origin = new Object();
        $decorator = new Decorator($origin);
        $origin->setId(666);
        $this->assertEquals('decorator id = 666', $decorator->render());
        $decorator->setId(777);
        $this->assertEquals('decorator id = 777', $decorator->render());
    }
    public function testDecoratorOnlyMethod()
    {
        $origin = new Object();
        $decorator = new Decorator($origin);
        $this->assertTrue($decorator->decoratorOnlyMethod());
    }
}