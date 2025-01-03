<?php

namespace olcaytaner\Framenet;

class FrameElement
{
    private string $frameElementType;
    private string $frame;
    private string $id;

    /**
     * A constructor of {@link FrameElement} class which takes frameElement string which is in the form of frameElementType$id
     * and parses this string into frameElementType and id. If the frameElement string does not contain '$' then the
     * constructor return a NONE type frameElement.
     *
     * @param string $frameElement  Argument string containing the argumentType and id
     * @param string|null $frame  Frame of the frameElement
     * @param string|null $id Id of the frameElement
     */
    public function __construct(string $frameElement, string $frame = null, string $id = null)
    {
        if ($frame == null){
            if (str_contains($frameElement, "$")){
                $this->frameElementType = substr($frameElement, 0, strpos($frameElement, "$"));
                $this->frame = substr($frameElement, strpos($frameElement, "$") + 1, strrpos($frameElement, "$") - strpos($frameElement, "$") - 1);
                $this->id = substr($frameElement, strrpos($frameElement, "$") + 1);
            } else {
                $this->frameElementType = "NONE";
            }
        } else {
            $this->frameElementType = $frameElement;
            $this->frame = $frame;
            $this->id = $id;
        }
    }

    /**
     * Accessor for frameElementType.
     *
     * @return string frameElementType.
     */
    public function getFrameElementType(): string
    {
        return $this->frameElementType;
    }

    /**
     * Accessor for frame.
     *
     * @return string frame.
     */
    public function getFrame(): string
    {
        return $this->frame;
    }

    /**
     * Accessor for id.
     *
     * @return string id.
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * toString converts an {@link FrameElement} to a string. If the frameElementType is "NONE" returns only "NONE", otherwise
     * it returns argument string which is in the form of frameElementType$id
     *
     * @return string string form of frameElement
     */
    public function __toString(): string{
        if ($this->frameElementType == "NONE"){
            return $this->frameElementType;
        } else {
            return $this->frameElementType . "$" . $this->frame . "$" . $this->id;
        }
    }
}