<?php

namespace Artcustomer\MistralAIClient\Connector;

use Artcustomer\ApiUnit\Client\AbstractApiClient;
use Artcustomer\ApiUnit\Connector\AbstractConnector;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\ApiUnit\Utils\ApiMethodTypes;
use Artcustomer\MistralAIClient\Http\ChatRequest;
use Artcustomer\MistralAIClient\Http\ModerationRequest;
use Artcustomer\MistralAIClient\Utils\ApiEndpoints;

/**
 * @author David
 */
class ClassifierConnector extends AbstractConnector
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
     * Create a chat moderation
     *
     * @param array $params
     * @return IApiResponse
     */
    public function createModeration(array $params): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::POST,
            'endpoint' => '',
            'body' => $params
        ];
        $request = $this->client->getRequestFactory()->instantiate(ModerationRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }

    /**
     * Create a chat moderation
     *
     * @param array $params
     * @return IApiResponse
     */
    public function createChatModeration(array $params): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::POST,
            'endpoint' => ApiEndpoints::MODERATIONS,
            'body' => $params
        ];
        $request = $this->client->getRequestFactory()->instantiate(ChatRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }
}