<?php

namespace ZendDiagnostics\Check;

use ZendDiagnostics\Result\Failure;
use ZendDiagnostics\Result\Success;

/**
 * Checks if a YAML file is available and valid
 */
class YamlFile extends AbstractFileCheck
{
    /**
     * {@inheritdoc}
     */
    protected function validateFile($file)
    {
        if (!class_exists('Symfony\Component\Yaml\Parser')) {
            return new Failure('This check needs a YAML parser! Please install "symfony/yaml".');
        }

        $parser = new \Symfony\Component\Yaml\Parser();

        try {
            $parser->parse(file_get_contents($file));
        } catch (\Symfony\Component\Yaml\Exception\ParseException $e) {
            return new Failure(sprintf('Unable to parse YAML file "%s"!', $file), $e->getMessage());
        }

        return new Success();
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return 'YAML file check';
    }
} 