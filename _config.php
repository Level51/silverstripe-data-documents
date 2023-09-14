<?php

use Level51\DataDocuments\DataDocument;
use Level51\DataDocuments\DataDocumentExtension;
use SilverStripe\Core\ClassInfo;
use SilverStripe\ORM\DataObject;

foreach (ClassInfo::implementorsOf(DataDocument::class) as $dataDocumentClass) {
    DataObject::add_extension($dataDocumentClass, DataDocumentExtension::class);
}
