<?php

namespace Artcustomer\MistralAIClient\Connector;

use Artcustomer\ApiUnit\Client\AbstractApiClient;
use Artcustomer\ApiUnit\Connector\AbstractConnector;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\ApiUnit\Utils\ApiMethodTypes;
use Artcustomer\MistralAIClient\Http\BatchRequest;
use Artcustomer\MistralAIClient\Utils\ApiEndpoints;

/**
 * @author David
 */
class BatchConnector extends AbstractConnector
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
     * Get a list of batch jobs for your organization and user
     *
     * @return IApiResponse
     */
    public function list(): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::GET,
            'endpoint' => ApiEndpoints::JOBS
        ];
        $request = $this->client->getRequestFactory()->instantiate(BatchRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }

    /**
     * Create a new batch job, it will be queued for processing
     *
     * @param array $params
     * @return IApiResponse
     */
    public function create(array $params): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::POST,
            'endpoint' => ApiEndpoints::JOBS,
            'body' => $params
        ];
        $request = $this->client->getRequestFactory()->instantiate(BatchRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }

    /**
     * Get a batch job details by its UUID
     *
     * @param string $jobId
     * @return IApiResponse
     */
    public function get(string $jobId): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::GET,
            'endpoint' => sprintf('%s/%s', ApiEndpoints::JOBS, $jobId)
        ];
        $request = $this->client->getRequestFactory()->instantiate(BatchRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }

    /**
     * Request the cancellation of a batch job
     *
     * @param string $jobId
     * @return IApiResponse
     */
    public function cancel(string $jobId): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::POST,
            'endpoint' => sprintf('%s/%s/%s', ApiEndpoints::JOBS, $jobId, ApiEndpoints::CANCEL)
        ];
        $request = $this->client->getRequestFactory()->instantiate(BatchRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }
}
