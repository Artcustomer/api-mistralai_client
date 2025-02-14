<?php

namespace Artcustomer\MistralAIClient\Connector;

use Artcustomer\ApiUnit\Client\AbstractApiClient;
use Artcustomer\ApiUnit\Connector\AbstractConnector;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\ApiUnit\Utils\ApiMethodTypes;
use Artcustomer\MistralAIClient\Http\AgentRequest;
use Artcustomer\MistralAIClient\Utils\ApiEndpoints;

/**
 * @author David
 */
class AgentConnector extends AbstractConnector
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
     * Create an agent completion
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
        $request = $this->client->getRequestFactory()->instantiate(AgentRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }
}