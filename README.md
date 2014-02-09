RedmineWikiParser
===

## Использование

#### Парсим файл
<pre>
$parser = new \RedmineWikiParser\Parser;
$parser->open('input/newfile');
$parser->parse();
</pre>

#### Получаем содержимое как ассоциативный массив

<pre>
print_r($parser->toAssocArray());
</pre>