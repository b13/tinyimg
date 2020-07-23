<?php

namespace Schmitzal\Tinyimg\Service;

use TYPO3\CMS\Core\Resource\Processing\TaskInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

class LocalImageProcessor extends \TYPO3\CMS\Core\Resource\Processing\LocalImageProcessor
{

    /**
     * Processes the given task.
     *
     * @param TaskInterface $task
     * @throws \InvalidArgumentException
     */
    public function processTask(TaskInterface $task)
    {
        parent::processTask($task);
        if ($task->isExecuted() && $task->getTargetFile()->usesOriginalFile() === false) {
            $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
            $compressImageService = $objectManager->get(CompressImageService::class);
            $compressImageService->compressProcessedFile($task->getSourceFile(), $task->getTargetFile());
        }
    }
}
