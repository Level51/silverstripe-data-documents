<?php

namespace Level51\DataDocuments;

use Google\Cloud\Firestore\FirestoreClient;
use SilverStripe\Core\Environment;
use SilverStripe\Core\Injector\Injectable;

class Firestore implements DataDocumentStore
{
    use Injectable;

    private FirestoreClient $firestore;

    public function __construct(array $config = [])
    {
        if ($emulator = Environment::getEnv('FIRESTORE_EMULATOR_HOST')) {
            putenv('FIRESTORE_EMULATOR_HOST=' . $emulator);
        }

        $credentials = json_decode(Environment::getEnv('GOOGLE_APPLICATION_CREDENTIALS'), true);
        $config += [
            'keyFile' => $credentials
        ];

        $this->firestore = new FirestoreClient(array_merge(
            $config,
            [
                'projectId' => Environment::getEnv('FIREBASE_PROJECT')
            ]
        ));
    }

    public function read(string $documentId): array
    {
        return $this->firestore->document($documentId)->snapshot()->data();
    }

    public function write(string $documentId, array $document, array $options = []): void
    {
        $this->firestore->document($documentId)->set($document, $options);
    }

    public function delete(string $documentId): void
    {
        $this->firestore->document($documentId)->delete();
    }
}
