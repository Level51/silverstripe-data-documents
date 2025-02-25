<?php

namespace Level51\DataDocuments;

interface DataDocument
{
    public function getDocument(): array | null;

    public function getDocumentStore(): DataDocumentStore;
}
