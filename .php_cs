<?php

$header = <<<HEADER
test
HEADER;

$finder = \PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude('docs')
;

return \PhpCsFixer\Config::create()
    ->setCacheFile(__DIR__ . '/php_cs.cache')
    ->setRules([
        '@PSR2' => true,
        'array_syntax' => [
            'syntax' => 'short']
    ])
    ->setFinder($finder)
;
