<?php

namespace Artcustomer\MistralAIClient\Connector;

use Artcustomer\ApiUnit\Client\AbstractApiClient;
use Artcustomer\ApiUnit\Connector\AbstractConnector;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\ApiUnit\Utils\ApiMethodTypes;
use Artcustomer\MistralAIClient\Http\EmbeddingRequest;

/**
 * @author David
 */
class EmbeddingConnector extends AbstractConnector
{

    /**
     * Constructor
     *
     * @param AbstractApiClient $client
     */
    public function __construct(AbstractApiClient $client)
    {
        parent::__construct($client, false);
    }

    /**
     * Create an embedding
     *
     * @param array $params
     * @return IApiResponse
     */
    public function create(array $params): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::POST,
            'endpoint' => '',
            'body' => $params
        ];
        $request = $this->client->getRequestFactory()->instantiate(EmbeddingRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }
}