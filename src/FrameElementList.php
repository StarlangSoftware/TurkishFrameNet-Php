<?php

namespace olcaytaner\Framenet;

class FrameElementList
{
    private array $frameElements;

    /**
     * Constructor of frame element list from a string. The frame elements for a word is a concatenated list of
     * frame element separated via '#' character.
     * @param $frameElementList string String consisting of frame elements separated with '#' character.
     */
    public function __construct(string $frameElementList){
        $this->frameElements = [];
        $items = preg_split( "#", $frameElementList);
        foreach ($items as $item) {
            $this->frameElements[] = new FrameElement($item);
        }
    }

    /**
     * Overloaded toString method to convert a frame element list to a string. Concatenates the string forms of all
     * frame element with '#' character.
     * @return String form of the frame element list.
     */
    public function __toString(): string{
        if (count($this->frameElements) === 0) {
            return "NONE";
        } else {
            $result = $this->frameElements[0]->__toString();
            for ($i = 1; $i < count($this->frameElements); $i++) {
                $result .= "#" . $this->frameElements[$i]->__toString();
            }
            return $result;
        }
    }

    /**
     * Replaces id's of predicates, which have previousId as synset id, with currentId.
     * @param $previousId string Previous id of the synset.
     * @param $currentId string Replacement id.
     */
    public function updateConnectedId(string $previousId, string $currentId): void{
        foreach ($this->frameElements as $frameElement) {
            if ($frameElement->getId() == $previousId) {
                $frameElement->setId($currentId);
            }
        }
    }

    /**
     * Adds a predicate argument to the argument list of this word.
     * @param $predicateId string Synset id of this predicate.
     */
    public function addPredicate(string $predicateId): void{
        if (count($this->frameElements) != 0 && $this->frameElements[0]->getFrameElementType() == "NONE") {
            array_splice($this->frameElements, 0);
        }
        $this->frameElements[] = new FrameElement("PREDICATE", "NONE", $predicateId);
    }

    /**
     * Removes the predicate with the given predicate id.
     */
    public function removePredicate(): void{
        for ($i = 0; $i < count($this->frameElements); $i++) {
            $frameElement = $this->frameElements[$i];
            if ($frameElement->getFrameElementType() == "PREDICATE") {
                array_splice($this->frameElements, $i, 1);
                break;
            }
        }
    }

    /**
     * Checks if one of the frame elements is a predicate.
     * @return True, if one of the frame elements is predicate; false otherwise.
     */
    public function containsPredicate(): bool{
        foreach ($this->frameElements as $frameElement) {
            if ($frameElement->getFrameElementType() == "PREDICATE") {
                return true;
            }
        }
        return false;
    }

    /**
     * Checks if one of the frame element is a predicate with the given id.
     * @param $predicateId string Synset id to check.
     * @return True, if one of the frame element is predicate; false otherwise.
     */
    public function containsPredicateWithId(string $predicateId): bool{
        foreach ($this->frameElements as $frameElement) {
            if ($frameElement->getFrameElementType() == "PREDICATE" && $frameElement->getId() == $predicateId) {
                return true;
            }
        }
        return false;
    }

    /**
     * Returns the frame elements as an array list of strings.
     * @return array Frame elements as an array list of strings.
     */
    public function getFrameElements(): array{
        $result = [];
        foreach ($this->frameElements as $frameElement) {
            $result[] = $frameElement->__toString();
        }
        return $result;
    }

    /**
     * Checks if the given argument with the given type and id exists or not.
     * @param string $frameElementType Type of the frame element to search for.
     * @param string $frame frame Name of the frame to search for
     * @param string $id Id of the frame element to search for.
     * @return True if the frame element exists, false otherwise.
     */
    public function containsFrameElement(string $frameElementType, string $frame, string $id): bool{
        foreach ($this->frameElements as $frameElement) {
            if ($frameElement->getFrameElementType() == $frameElementType && $frameElement->getFrame() == $frame && $frameElement->getId() == $id) {
                return true;
            }
        }
        return false;
    }
}