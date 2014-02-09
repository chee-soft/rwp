<?php

namespace RedmineWikiParser\Line;

class BoldText extends Header
{

    protected function prepareText()
    {
        return trim($this->source, '* ');
    }

    public function prepareSize()
    {
        $headerLine = $this->parser->getPrevLine($this, array('Header'));

        return $headerLine->getSize() + 1;
    }

    public function getType()
    {
        return 'BoldText';
    }

}
