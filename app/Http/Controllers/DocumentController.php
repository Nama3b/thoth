<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentListRequest;
use App\Services\Interfaces\IDocumentService;
use App\Transfomers\Document\DocumentDetailTransformer;
use App\Transfomers\Document\DocumentListTransformer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\Fractalistic\ArraySerializer;

class DocumentController extends Controller
{
    protected IDocumentService $documentService;

    public function __construct(IDocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    public function index(DocumentListRequest $request)
    {
        return $this->withErrorHandling(function () use ($request) {
            $data = $this->documentService->list($request);

            return $this->response([
                'documents' => fractal()->collection($data)
                    ->transformWith(new DocumentListTransformer())
                    ->serializeWith(new ArraySerializer())
                    ->paginateWith(new IlluminatePaginatorAdapter($data))
                ]);
        });
    }

    public function get($id)
    {
        return $this->withErrorHandling(function () use($id) {
            $data = $this->documentService->detail($id);

            return $this->response([
                'document' => fractal()->item($data)
                    ->transformWith(new DocumentDetailTransformer())
                    ->serializeWith(new ArraySerializer())
            ]);
        });
    }
}
