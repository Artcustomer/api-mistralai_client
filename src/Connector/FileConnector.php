<?php

namespace Artcustomer\MistralAIClient\Connector;

use Artcustomer\ApiUnit\Client\AbstractApiClient;
use Artcustomer\ApiUnit\Connector\AbstractConnector;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\ApiUnit\Utils\ApiMethodTypes;
use Artcustomer\MistralAIClient\Http\FileRequest;
use Artcustomer\MistralAIClient\Utils\ApiEndpoints;

/**
 * @author David
 */
class FileConnector extends AbstractConnector
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
     * Returns a list of files that belong to the user's organization
     *
     * @return IApiResponse
     */
    public function list(): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::GET
        ];
        $request = $this->client->getRequestFactory()->instantiate(FileRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }

    /**
     * Upload a file that can be used across various endpoints
     *
     * @param array $params
     * @return IApiResponse
     */
    public function upload(array $params): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::POST,
            'body' => $params
        ];
        $request = $this->client->getRequestFactory()->instantiate(FileRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }

    /**
     * Delete a file
     *
     * @param string $fileId
     * @return IApiResponse
     */
    public function delete(string $fileId): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::DELETE,
            'endpoint' => $fileId
        ];
        $request = $this->client->getRequestFactory()->instantiate(FileRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }

    /**
     * Returns information about a specific file
     *
     * @param string $fileId
     * @return IApiResponse
     */
    public function get(string $fileId): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::GET,
            'endpoint' => $fileId
        ];
        $request = $this->client->getRequestFactory()->instantiate(FileRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }

    /**
     * Download a file
     *
     * @param string $fileId
     * @return IApiResponse
     */
    public function download(string $fileId): IApiResponse
    {
        $data = [
            'method' => ApiMethodTypes::GET,
            'endpoint' => sprintf('%s/%s', $fileId, ApiEndpoints::CONTENT)
        ];
        $request = $this->client->getRequestFactory()->instantiate(FileRequest::class, [$data]);

        return $this->client->executeRequest($request);
    }
}
