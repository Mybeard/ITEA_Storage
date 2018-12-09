<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__ . '/AbstractKeyValueFileStore.php';
use Symfony\Component\Yaml\Yaml;

class YamlFileStore extends AbstractKeyValueFileStore
{
    /**
     * {@inheritdoc}
     */
    protected function load(): array
    {
        $data = Yaml::parseFile($this->file);
        return \is_array($data) ? $data : [];
    }

    /**
     * {@inheritdoc}
     */
    protected function update(array $data): void
    {
        $yaml = Yaml::dump($data);
        \file_put_contents($this->file, $yaml, \LOCK_EX);
    }
}
