<?php

namespace Level51\DataDocuments;

interface DataDocumentStore
{
    public function read(string $documentId): array | null;

    public function write(string $documentId, array $document, array $options = []): void;

    public function delete(string $documentId): void;
}
