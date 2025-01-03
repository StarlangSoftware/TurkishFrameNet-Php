<?php


use olcaytaner\Framenet\FrameElement;
use PHPUnit\Framework\TestCase;

class FrameElementTest extends TestCase
{
    public function testFrameElement()
    {
        $frameElement = new FrameElement('Agent$Apply_Heat$TUR10-0100230');
        $this->assertEquals("Agent", $frameElement->getFrameElementType());
        $this->assertEquals("Apply_Heat", $frameElement->getFrame());
        $this->assertEquals("TUR10-0100230", $frameElement->getId());
        $this->assertEquals('Agent$Apply_Heat$TUR10-0100230', $frameElement->__toString());
    }
}
