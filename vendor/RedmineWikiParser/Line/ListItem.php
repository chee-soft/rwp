<?php

namespace RedmineWikiParser\Line;

class ListItem extends BoldText
{

    public function getType()
    {
        return 'ListItem';
    }

    public function prepareSize()
    {
        $headerLine = $this->parser->getPrevLine($this, array('BoldText', 'Header'));

        $firstSpace = strpos($this->source, ' ');
        
        return $headerLine->getSize() + $firstSpace;
    }

    protected function prepareText()
    {
        return ltrim($this->source, '* ');
    }

}
