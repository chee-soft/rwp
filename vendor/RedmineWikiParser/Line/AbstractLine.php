<?php

namespace RedmineWikiParser\Line;

abstract class AbstractLine
{

    protected $source;
    protected $text;
    protected $parser;
    protected $line;
    protected $type;

    public function __construct($line, $source, $parser)
    {
        $this->line = $line;
        $this->source = $source;
        $this->parser = $parser;
        $this->text = $this->prepareText();
    }

    protected function prepareText()
    {
        return trim($this->source);
    }

    public function getText()
    {
        return $this->text;
    }

    public function getLine()
    {
        return $this->line;
    }

    public function getType()
    {
        return $this->type;
    }

}
