<?php

namespace App\Services\Interfaces;

interface IDocumentService
{
    public function list($request);

    public function detail($id);
}
