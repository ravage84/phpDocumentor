<?php

declare(strict_types=1);

/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @link https://phpdoc.org
 */

namespace phpDocumentor\Compiler\ApiDocumentation\Pass;

use phpDocumentor\Compiler\ApiDocumentation\ApiDocumentationPass;
use phpDocumentor\Descriptor\ApiSetDescriptor;

final class RemoveSourcecode extends ApiDocumentationPass
{
    public const COMPILER_PRIORITY = 2000;

    public function getDescription(): string
    {
        return 'Removing sourcecode from file descriptors';
    }

    protected function process(ApiSetDescriptor $subject): ApiSetDescriptor
    {
        if ($subject->getSettings()['include-source']) {
            return $subject;
        }

        foreach ($subject->getFiles() as $file) {
            if ($subject->getSettings()['include-source'] !== false && $file->getTags()->fetch('filesource') !== null) {
                continue;
            }

            $file->setSource(null);
        }

        return $subject;
    }
}
