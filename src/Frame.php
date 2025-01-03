<?php

namespace olcaytaner\Framenet;

class Frame
{
    private string $name;
    private array $lexicalUnits;
    private array $frameElements;

    /**
     * Constructor of {@link Frame} class which takes inputStream as input and reads the frame
     *
     * @param string $name Name of the frame
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->lexicalUnits = [];
        $this->frameElements = [];
    }

    /**
     * Adds a new lexical unit to the current frame
     * @param string $lexicalUnit Lexical unit to be added
     */
    public function addLexicalUnit(string $lexicalUnit)
    {
        $this->lexicalUnits[] = $lexicalUnit;
    }

    /**
     * Adds a new frame element to the current frame
     * @param string $frameElement Frame element to be added
     */
    public function addFrameElement(string $frameElement)
    {
        $this->frameElements[] = $frameElement;
    }

    /**
     * Checks if the given lexical unit exists in the current frame
     * @param string $lexicalUnit Lexical unit to be searched.
     * @return bool True if the lexical unit exists, false otherwise.
     */
    public function lexicalUnitExists(string $lexicalUnit): bool
    {
        return in_array($lexicalUnit, $this->lexicalUnits, true);
    }

    /**
     * Accessor for a given index in the lexicalUnit array.
     * @param int $index Index of the lexical unit
     * @return string The lexical unit at position index in the lexicalUnit array
     */
    public function getLexicalUnit(int $index): string
    {
        return $this->lexicalUnits[$index];
    }

    /**
     * Accessor for a given index in the frameElements array.
     * @param int $index Index of the frame element
     * @return string The frame element at position index in the frameElements array
     */
    public function getFrameElement(int $index): string
    {
        return $this->frameElements[$index];
    }

    /**
     * Returns number of lexical units in the current frame
     * @return int Number of lexical units in the current frame
     */
    public function lexicalUnitSize(): int
    {
        return count($this->lexicalUnits);
    }

    /**
     * Returns number of frame elements in the current frame
     * @return int Number of frame elements in the current frame
     */
    public function frameElementSize(): int
    {
        return count($this->frameElements);
    }

    /**
     * Accessor for the name of the frame
     * @return string Name of the frame
     */
    public function getName(): string
    {
        return $this->name;
    }
}