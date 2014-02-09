<?php

namespace RedmineWikiParser\Handler;

use RedmineWikiParser\Line;

class AssocArray
{

    /**
     * @var \RedmineWikiParser\Parser
     */
    protected $parser;

    public function __construct(\RedmineWikiParser\Parser $parser)
    {
        $this->parser = $parser;
    }

    protected $lines = array();
    protected $assocPath = array();
    protected $result;

    public function toArray()
    {
        foreach ($this->parser->getLines() as $line) {

            if ($line instanceof Line\Toc) {
                continue;
            }
            
            if ($line instanceof Line\EmptyLine) {
                continue;
            }

            if ($line instanceof Line\Header) {
                $this->addHeader($line);
                $this->setValue($this->assocPath, array());
                continue;
            }
            
            $assocPath = $this->assocPath + array($line->getText());

            $this->setValue($assocPath, null);
        }

        return $this->result;
    }

    protected function setValue(array $path, $value)
    {
        $result = & $this->result;

        foreach ($path as $pathItem) {

            if (!isset($result[$pathItem])) {
                $result[$pathItem] = array();
            }

            $result = & $result[$pathItem];
        }

        $result = $value;
    }

    protected function addHeader(Line\Header $line)
    {
        $size = $line->getSize();
        if ($size < count($this->assocPath)) {
            $this->assocPath = array_slice($this->assocPath, 0, $size - 1);
        }
        if ($size == count($this->assocPath)) {
            $this->assocPath = array_slice($this->assocPath, 0, $size - 1);
        }
        $this->assocPath[$line->getSize()] = $line->getText();
    }

}