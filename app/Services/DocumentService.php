<?php

namespace App\Services;

use App\Models\Document;
use App\Services\Interfaces\IDocumentService;

class DocumentService implements IDocumentService
{
    public function list($request)
    {
        $query = Document::query();


    }

    public function detail($id)
    {

    }
}
