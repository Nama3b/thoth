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
        // TODO: Implement detail() method.
    }

    public function create($request)
    {
        // TODO: Implement create() method.
    }

    public function edit($id, $request)
    {
        // TODO: Implement edit() method.
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}
