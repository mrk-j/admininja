<?php
class ArrayTest extends PHPUnit_Framework_TestCase
{
    public function testArray()
    {
        $array = array();
        $this->assertEquals(0, count($array));
    }
}
