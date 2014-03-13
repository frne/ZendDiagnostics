<?php

namespace ZendDiagnostics\Check;

use ZendDiagnostics\Result\Failure;
use ZendDiagnostics\Result\Success;

/**
 * Checks if an INI file is available and valid
 */
class IniFile extends AbstractFileCheck
{
    /**
     * {@inheritdoc}
     */
    protected function validateFile($file)
    {
        if (!is_array($ini = parse_ini_file($file)) or count($ini) < 1 ) {
            return new Failure(sprintf('Could not parse INI file "%s"!', $file));
        }

        return new Success();
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return 'INI file check';
    }
} 