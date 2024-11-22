<?php

namespace Artcustomer\MistralAIClient;

use Artcustomer\ApiUnit\Gateway\AbstractApiGateway;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\MistralAIClient\Utils\ApiInfos;

/**
 * @author David
 */
class MistralAIApiGateway extends AbstractApiGateway
{

    private string $apiKey;
    private bool $availability;

    /**
     * Constructor
     *
     * @param string $apiKey
     * @param bool $availability
     */
    public function __construct(string $apiKey, bool $availability)
    {
        $this->apiKey = $apiKey;
        $this->availability = $availability;

        $this->defineParams();

        parent::__construct();
    }

    /**
     * Initialize
     *
     * @return void
     */
    public function initialize(): void
    {
        $this->setupConnectors();

        $this->client->initialize();
    }

    /**
     * Test API
     *
     * @return IApiResponse
     */
    public function test(): IApiResponse
    {

    }

    /**
     * Setup connectors
     *
     * @return void
     */
    private function setupConnectors(): void
    {

    }

    /**
     * Define parameters
     *
     * @return void
     */
    private function defineParams(): void
    {
        $this->params['api_name'] = ApiInfos::API_NAME;
        $this->params['api_version'] = ApiInfos::API_VERSION;
        $this->params['protocol'] = ApiInfos::PROTOCOL;
        $this->params['host'] = ApiInfos::HOST;
        $this->params['version'] = ApiInfos::VERSION;
        $this->params['api_key'] = $this->apiKey;
        $this->params['availability'] = $this->availability;
    }
}
