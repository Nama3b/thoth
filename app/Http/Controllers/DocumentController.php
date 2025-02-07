<?php

namespace App\Http\Controllers;

use App\Http\Requests\Document\DocumentCreateRequest;
use App\Http\Requests\Document\DocumentListRequest;
use App\Http\Requests\Document\DocumentUpdateRequest;
use App\Services\Interfaces\IDocumentService;
use App\Transfomers\Document\DocumentDetailTransformer;
use App\Transfomers\Document\DocumentListTransformer;
use Illuminate\Http\JsonResponse;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\Fractalistic\ArraySerializer;
use Throwable;

class DocumentController extends Controller
{
    /**
     * @var IDocumentService
     */
    protected IDocumentService $documentService;

    /**
     * @param IDocumentService $documentService
     */
    public function __construct(IDocumentService $documentService)
    {
        $this->documentService = $documentService;
    }

    /**
     * @param DocumentListRequest $request
     * @return JsonResponse
     */
    public function index(DocumentListRequest $request): JsonResponse
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

    /**
     * @param $id
     * @return JsonResponse
     */
    public function get($id): JsonResponse
    {
        return $this->withErrorHandling(function () use ($id) {
            $data = $this->documentService->detail($id);

            return $this->response([
                'document' => fractal()->item($data)
                    ->transformWith(new DocumentDetailTransformer())
                    ->serializeWith(new ArraySerializer())
            ]);
        });
    }

    /**
     * @param DocumentCreateRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function create(DocumentCreateRequest $request): JsonResponse
    {
        return $this->withTransactionErrorHandling(function () use ($request) {
            $data = $this->documentService->create($request);

            return optional($data) ?
                $this->message(__('Create entity successfully'))->respondCreated() :
                $this->message(__('An unexpected error occurred. Please try again later.'))
                    ->respondBadRequest();
        });
    }

    /**
     * @param $id
     * @param DocumentUpdateRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function edit($id, DocumentUpdateRequest $request): JsonResponse
    {
        return $this->withTransactionErrorHandling(function () use ($id, $request) {
            $data = $this->documentService->edit($id, $request);

            return optional($data) ?
                $this->message(__('Update entity successfully'))->respondOk() :
                $this->message(__('An unexpected error occurred. Please try again later.'))
                    ->respondBadRequest();
        });
    }

    /**
     * @param $id
     * @return JsonResponse
     * @throws Throwable
     */
    public function delete($id): JsonResponse
    {
        return $this->withTransactionErrorHandling(function () use ($id) {
            $data = $this->documentService->delete($id);

            return optional($data) ?
                $this->message(__('Delete entity successfully'))->respondOk() :
                $this->message(__('An unexpected error occurred. Please try again later.'))
                    ->respondBadRequest();
        });
    }
}
