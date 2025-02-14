<?php

namespace Artcustomer\MistralAIClient;

use Artcustomer\ApiUnit\Gateway\AbstractApiGateway;
use Artcustomer\ApiUnit\Http\IApiResponse;
use Artcustomer\MistralAIClient\Client\ApiClient;
use Artcustomer\MistralAIClient\Connector\AgentConnector;
use Artcustomer\MistralAIClient\Connector\BatchConnector;
use Artcustomer\MistralAIClient\Connector\ChatConnector;
use Artcustomer\MistralAIClient\Connector\ClassifierConnector;
use Artcustomer\MistralAIClient\Connector\EmbeddingConnector;
use Artcustomer\MistralAIClient\Connector\FileConnector;
use Artcustomer\MistralAIClient\Connector\FimConnector;
use Artcustomer\MistralAIClient\Connector\FineTuningConnector;
use Artcustomer\MistralAIClient\Connector\ModelConnector;
use Artcustomer\MistralAIClient\Utils\ApiInfos;

/**
 * @author David
 */
class MistralAIApiGateway extends AbstractApiGateway
{

    private AgentConnector $agentConnector;
    private BatchConnector $batchConnector;
    private ChatConnector $chatConnector;
    private ClassifierConnector $classifierConnector;
    private EmbeddingConnector $embeddingConnector;
    private FileConnector $fileConnector;
    private FimConnector $fimConnector;
    private FineTuningConnector $fineTuningConnector;
    private ModelConnector $modelConnector;

    private string $apiKey;
    private bool $availability;

    /**
     * Constructor
     *
     * @param string $apiKey
     * @param bool $availability
     * @throws \ReflectionException
     */
    public function __construct(string $apiKey, bool $availability)
    {
        $this->apiKey = $apiKey;
        $this->availability = $availability;

        $this->defineParams();

        parent::__construct(ApiClient::class, [$this->params]);
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
        return $this->modelConnector->list();
    }

    /**
     * Get AgentConnector instance
     *
     * @return AgentConnector
     */
    public function getAgentConnector(): AgentConnector
    {
        return $this->agentConnector;
    }

    /**
     * Get BatchConnector instance
     *
     * @return BatchConnector
     */
    public function getBatchConnector(): BatchConnector
    {
        return $this->batchConnector;
    }

    /**
     * Get ChatConnector instance
     *
     * @return ChatConnector
     */
    public function getChatConnector(): ChatConnector
    {
        return $this->chatConnector;
    }

    /**
     * Get ClassifierConnector instance
     *
     * @return ClassifierConnector
     */
    public function getClassifierConnector(): ClassifierConnector
    {
        return $this->classifierConnector;
    }

    /**
     * Get EmbeddingConnector instance
     *
     * @return EmbeddingConnector
     */
    public function getEmbeddingConnector(): EmbeddingConnector
    {
        return $this->embeddingConnector;
    }

    /**
     * Get FileConnector instance
     *
     * @return FileConnector
     */
    public function getFileConnector(): FileConnector
    {
        return $this->fileConnector;
    }

    /**
     * Get FimConnector instance
     *
     * @return FimConnector
     */
    public function getFimConnector(): FimConnector
    {
        return $this->fimConnector;
    }

    /**
     * Get FineTuningConnector instance
     *
     * @return FineTuningConnector
     */
    public function getFineTuningConnector(): FineTuningConnector
    {
        return $this->fineTuningConnector;
    }

    /**
     * Get ModelConnector instance
     *
     * @return ModelConnector
     */
    public function getModelConnector(): ModelConnector
    {
        return $this->modelConnector;
    }

    /**
     * Setup connectors
     *
     * @return void
     */
    private function setupConnectors(): void
    {
        $this->agentConnector = new AgentConnector($this->client);
        $this->batchConnector = new BatchConnector($this->client);
        $this->chatConnector = new ChatConnector($this->client);
        $this->classifierConnector = new ClassifierConnector($this->client);
        $this->embeddingConnector = new EmbeddingConnector($this->client);
        $this->fileConnector = new FileConnector($this->client);
        $this->fimConnector = new FimConnector($this->client);
        $this->fineTuningConnector = new FineTuningConnector($this->client);
        $this->modelConnector = new ModelConnector($this->client);
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
