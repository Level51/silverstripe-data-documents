<?php

namespace Level51\DataDocuments;

interface DataDocument
{
    public function getDocument(): array;

    public function getDocumentStore(): DataDocumentStore;
}
