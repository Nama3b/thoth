<?php

namespace App\Transfomers\Document;

use League\Fractal\TransformerAbstract;

class DocumentDetailTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        //
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        //
    ];

    /**
     * A Fractal transformer.
     *
     * @param $data
     * @return array
     */
    public function transform($data): array
    {
        return [

        ];
    }

}
