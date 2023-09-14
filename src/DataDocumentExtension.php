<?php

namespace Level51\DataDocuments;

use SilverStripe\ORM\DataExtension;

/**
 * @property DataDocument|DataDocumentExtension $owner
 */
class DataDocumentExtension extends DataExtension
{
    public function onAfterWrite()
    {
        parent::onAfterWrite();

        $this->commit();
    }

    /**
     * Used to ensure data is being committed if only relations have been changed
     */
    public function onAfterSkippedWrite()
    {
        if ($this->getOwner()->validate()->isValid()) {
            $this->commit();
        }
    }

    public function onBeforeDelete()
    {
        parent::onBeforeDelete();

        $this->undoCommit();
    }

    public function commit(): void
    {
        if ($this->getOwner()->hasMethod('canCommit') && !$this->getOwner()->canCommit()) {
            return;
        }

        $options = $this->getOwner()->hasMethod('getDocumentWriteOptions')
            ? $this->getOwner()->getDocumentWriteOptions()
            : [];

        $this->getOwner()->getDocumentStore()->write(
            $this->getOwner()->getDocumentId(),
            $this->getOwner()->getDocument(),
            $options
        );
    }

    public function undoCommit(): void
    {
        $this->getOwner()->getDocumentStore()->delete($this->getOwner()->getDocumentId());
    }

    public function getDocumentId(): string
    {
        return $this->getOwner()->ID;
    }
}
