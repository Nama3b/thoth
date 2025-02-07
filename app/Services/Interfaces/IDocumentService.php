<?php

namespace App\Services\Interfaces;

interface IDocumentService
{
    public function list($request);

    public function detail($id);

    public function create($request);

    public function edit($id, $request);

    public function delete($id);
}
