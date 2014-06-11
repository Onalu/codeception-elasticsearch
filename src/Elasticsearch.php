<?php
/**
 * Created by IntelliJ IDEA.
 * User: umutcan
 * Date: 11.06.2014
 * Time: 09:59
 */

namespace Codeception\Module;

use Codeception\Module;
use Elasticsearch\Client as ESClient;

class Elasticsearch extends Module
{
    protected $esClient;

    /**
     * @var array
     */
    protected $config = array(
        'host',
        'port'  => 9200
    );

    /**
     * @var array
     */
    protected $requiredFields = array(
        'host'
    );

    public function _initialize()
    {
        $params = array(
            "hosts" => array(
                $this->config["host"].":".$this->config["port"]
            )
        );
        $this->esClient = new ESClient($params);
    }

    public function seeClusterStatusGreen()
    {
        $response =  $this->esClient->cluster()->health();
        $this->assertContains("green", $response["statatus"]);
    }

} 