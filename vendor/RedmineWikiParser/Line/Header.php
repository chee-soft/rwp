<?php

namespace RedmineWikiParser\Line;

class Header extends AbstractLine
{

    protected $size;

    public function __construct($line, $source, $parser)
    {
        parent::__construct($line, $source, $parser);
        $this->size = (int) $this->prepareSize();
    }

    protected function prepareText()
    {
        return trim(mb_substr($this->source, 3));
    }

    protected function prepareSize()
    {
        return mb_substr($this->source, 1, 1);
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getType()
    {
        return 'Header';
    }

}
