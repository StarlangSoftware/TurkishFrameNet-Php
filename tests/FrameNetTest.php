<?php


use olcaytaner\Framenet\FrameNet;
use PHPUnit\Framework\TestCase;

class FrameNetTest extends TestCase
{
    public function setUp(): void
    {
        $this->frameNet = new FrameNet();
    }

    public function testFrameSize(){
        $this->assertEquals(809, $this->frameNet->size());
    }

    public function testLexicalUnitSize(){
        $count = 0;
        for ($i = 0; $i < $this->frameNet->size(); $i++) {
            $count += $this->frameNet->getFrame($i)->lexicalUnitSize();
        }
        $this->assertEquals(8493, $count);
    }

    public function testFrameElementSize(){
        $count = 0;
        for ($i = 0; $i < $this->frameNet->size(); $i++) {
            $count += $this->frameNet->getFrame($i)->frameElementSize();
        }
        $this->assertEquals(8656, $count);
    }

    public function testDistinctFrameElements(){
        $elements = [];
        for ($i = 0; $i < $this->frameNet->size(); $i++) {
            for ($j = 0; $j < $this->frameNet->getFrame($i)->frameElementSize(); $j++) {
                $elements[$this->frameNet->getFrame($i)->getFrameElement($j)] = null;
            }
        }
        $this->assertCount(1012, $elements);
    }
}
