# Data Documents

Low-effort approach for syncing your DataObject with document-based payload stores such
Firestore, Pocketbase, Elasticsearch, Redis, ...

Inspired by the CQRS pattern, you can think of this module as a headless approach
without any public API exposed by your Silverstripe app.

## Installation

Make sure to require the base module...

```
composer require level51/silverstripe-data-documents
```

...and the payload store adapter of your choice.

- [**Firestore**](https://github.com/Level51/silverstripe-data-documents-firestore): `composer require level51/silverstripe-data-documents-firestore`
- [**Pocketbase**](https://github.com/Level51/silverstripe-data-documents-pocketbase): `composer require level51/silverstripe-data-documents-pocketbase`
- (adapter library in the making)

It is faily easy to create your own adapter. Just create a class and make it
implement the `DataDocumentStore` interface.

## Recipe

1. Install or create a document store adapter
2. Make your DataObject implement the `DataDocument` interface
3. Start manipulating your DataObject and check your document store

## What is CQRS?

CQRS is an architectural pattern that separates the concerns of reading (query) and
writing (command) operations in your application. This separation provides several benefits,
including improved performance, code organization, and maintainability.
