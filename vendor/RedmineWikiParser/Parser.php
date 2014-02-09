<?php

namespace RedmineWikiParser;

class Parser
{

    protected $encode;
    protected $lines = array();

    public function open($filename)
    {
        $this->encode = file($filename);
    }

    public function parse()
    {
        $this->lines = array();

        foreach ($this->encode as $key => $value) {
            $this->lines[$key] = $this->initLine($key, $value);
        }
 
        return $this->lines;
    }

    protected function initLine($key, $line)
    {
        $line = trim($line);

        if (!mb_strlen($line)) {
            return new Line\EmptyLine($key, $line, $this);
        }

        $firstChar = mb_substr($line, 0, 1);

        if ($firstChar === 'h' && mb_substr($line, 2, 1) === '.') {
            return new Line\Header($key, $line, $this);
        }

        if ($firstChar === '*' && mb_substr($line, -1) === '*') {
            return new Line\BoldText($key, $line, $this);
        }

        $firstSpace = strpos($line, ' ');

        if ($firstChar === '*' && preg_match("/^[\*]+$/", mb_substr($line, 0, $firstSpace))) {
            return new Line\ListItem($key, $line, $this);
        }

        if ($line === '{{toc}}') {
            return new Line\Toc($key, $line, $this);
        }

        return new Line\Text($key, $line, $this);
    }

    public function toAssocArray()
    {
        $handler = new Handler\AssocArray($this);

        return $handler->toArray();
    }

    public function getLines()
    {
        return $this->lines;
    }

    public function getPrevLine(Line\AbstractLine $line, array $typeLine = array())
    {
        if (empty($typeLine)) {
            return $this->lines[$line->getLine() - 1];
        }
        
        for ($l = $line->getLine() - 1; $l > 0; $l--) {
            if (in_array($this->lines[$l]->getType(), $typeLine, true)) {
                return $this->lines[$l];
            }
        }
        
        return null;
    }

}