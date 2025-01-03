<?php

namespace olcaytaner\Framenet;

use olcaytaner\XmlParser\XmlDocument;

class FrameNet
{
    private array $frames;

    /**
     * A constructor of {@link FrameNet} class which reads all frame files inside the files2.txt file. For each
     * filename inside that file, the constructor creates a FrameNet.Frame and puts in inside the frames {@link ArrayList}.
     */
    public function __construct()
    {
        $this->frames = [];
        $xmlDocument = new XmlDocument("../framenet.xml");
        $xmlDocument->parse();
        $rootNode = $xmlDocument->getFirstChild();
        $frameNode = $rootNode->getFirstChild();
        while ($frameNode != null) {
            $currentFrame = new Frame($frameNode->getAttributeValue("NAME"));
            $lexicalUnits = $frameNode->getFirstChild();
            $lexicalUnit = $lexicalUnits->getFirstChild();
            while ($lexicalUnit != null) {
                $currentFrame->addLexicalUnit($lexicalUnit->getPcData());
                $lexicalUnit = $lexicalUnit->getNextSibling();
            }
            $frameElements = $lexicalUnits->getNextSibling();
            $frameElement = $frameElements->getFirstChild();
            while ($frameElement != null) {
                $currentFrame->addFrameElement($frameElement->getPcData());
                $frameElement = $frameElement->getNextSibling();
            }
            $this->frames[] = $currentFrame;
            $frameNode = $frameNode->getNextSibling();
        }
    }

    /**
     * Checks if the given lexical unit exists in any frame in the frame set.
     * @param string $synSetId Id of the lexical unit
     * @return bool True if any frame contains the given lexical unit, false otherwise.
     */
    public function lexicalUnitExists(string $synSetId): bool
    {
        foreach ($this->frames as $frame) {
            if ($frame instanceof Frame && $frame->lexicalUnitExists($synSetId)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Returns an array of frames that contain the given lexical unit in their lexical units
     * @param string $synSetId Id of the lexical unit.
     * @return array An array of frames that contains the given lexical unit.
     */
    public function getFrames(string $synSetId): array
    {
        $result = [];
        foreach ($this->frames as $frame) {
            if ($frame instanceof Frame && $frame->lexicalUnitExists($synSetId)) {
                $result[] = $frame;
            }
        }
        return $result;
    }

    /**
     * Returns number of frames in the frame set.
     * @return int Number of frames in the frame set.
     */
    public function size(): int
    {
        return count($this->frames);
    }

    /**
     * Returns the element at the specified position in the frame list.
     * @param int $index index of the element to return
     * @return Frame The element at the specified position in the frame list.
     */
    public function getFrame(int $index): Frame
    {
        return $this->frames[$index];
    }
}