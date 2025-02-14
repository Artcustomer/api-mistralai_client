<?php

namespace Artcustomer\MistralAIClient\Connector;

use Artcustomer\ApiUnit\Client\AbstractApiClient;
use Artcustomer\ApiUnit\Connector\AbstractConnector;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\ApiUnit\Utils\ApiMethodTypes;
use Artcustomer\MistralAIClient\Http\FimRequest;
use Artcustomer\MistralAIClient\Utils\ApiEndpoints;

/**
 * @author David
 */
class FimConnector extends AbstractConnector
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
     * Create a FIM completion
     *
     * @param array $params
     * @return IApiResponse
     */
    public function createCompletion(array $params): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::POST,
            'endpoint' => ApiEndpoints::COMPLETIONS,
            'body' => $params
        ];
        $request = $this->client->getRequestFactory()->instantiate(FimRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }
}