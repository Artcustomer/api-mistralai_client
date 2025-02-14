<?php

namespace Artcustomer\MistralAIClient\Connector;

use Artcustomer\ApiUnit\Client\AbstractApiClient;
use Artcustomer\ApiUnit\Connector\AbstractConnector;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\ApiUnit\Utils\ApiMethodTypes;
use Artcustomer\MistralAIClient\Http\FineTuningRequest;
use Artcustomer\MistralAIClient\Utils\ApiEndpoints;

/**
 * @author David
 */
class FineTuningConnector extends AbstractConnector
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
     * Get a list of fine-tuning jobs for your organization and user
     *
     * @return IApiResponse
     */
    public function list(): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::GET,
            'endpoint' => ApiEndpoints::JOBS
        ];
        $request = $this->client->getRequestFactory()->instantiate(FineTuningRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }

    /**
     * Create a new fine-tuning job, it will be queued for processing
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
        $request = $this->client->getRequestFactory()->instantiate(FineTuningRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }

    /**
     * Get a fine-tuned job details by its UUID
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
        $request = $this->client->getRequestFactory()->instantiate(FineTuningRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }

    /**
     * Request the cancellation of a fine tuning job
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
        $request = $this->client->getRequestFactory()->instantiate(FineTuningRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }

    /**
     * Request the start of a validated fine tuning job
     *
     * @param string $jobId
     * @return IApiResponse
     */
    public function start(string $jobId): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::POST,
            'endpoint' => sprintf('%s/%s/%s', ApiEndpoints::JOBS, $jobId, ApiEndpoints::START)
        ];
        $request = $this->client->getRequestFactory()->instantiate(FineTuningRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }
}
