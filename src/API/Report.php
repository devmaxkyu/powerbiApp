<?php

namespace Tngnt\PBI\API;

use Tngnt\PBI\Client;

/**
 * Class Report
 *
 * @package Tngnt\PBI\API
 */
class Report
{
    const REPORT_URL = "https://api.powerbi.com/v1.0/myorg/reports";
    const GROUP_REPORT_URL = "https://api.powerbi.com/beta/myorg/groups/%s/reports";

    const REBIND_REPORT_URL = 'https://api.powerbi.com/v1.0/myorg/reports/%s/Rebind';
    const REBIND_REPORT_IN_GROUP_URL = 'https://api.powerbi.com/v1.0/myorg/groups/%s/reports/%s/Rebind';

    const EXPORT_REPORT = 'https://api.powerbi.com/v1.0/myorg/reports/{reportId}/Export';
    const EXPORT_REPORT_IN_GROUP_URL = 'https://api.powerbi.com/v1.0/myorg/groups/%s/reports/%s/Export';
    /**
     * The SDK client
     *
     * @var Client
     */
    private $client;

    /**
     * Table constructor.
     *
     * @param Client $client The SDK client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Retrieves a list of reports on PowerBI
     *
     * @param null|string $groupId An optional group ID
     *
     * @return \Tngnt\PBI\Response
     */
    public function getReports($groupId = null)
    {
        $url = $this->getUrl($groupId);

        $response = $this->client->request(Client::METHOD_GET, $url);

        return $this->client->generateResponse($response);
    }

    /**
     * Helper function to format the request URL
     *
     * @param null|string $groupId An optional group ID
     *
     * @return string
     */
    private function getUrl($groupId)
    {
        if ($groupId) {
            return sprintf(self::GROUP_REPORT_URL, $groupId);
        }

        return self::REPORT_URL;
    }

    /**
     *  Rebinds the specified report from the specified workspace to the requested dataset.
     *
     * @param string $reportId The report id
     * @param string $datasetId The new dataset of the rebinded report
     * @param string $groupId (optional)  The workspace id 
     * @return \Tngnt\PBI\Response
     */
    public function RebindReport($reportId, $datasetId, $groupId=null){
            // Generate the URL
            if($groupId){
                $url = sprintf(self::REBIND_REPORT_IN_GROUP_URL, $groupId, $reportId);
            }else{
                $url = sprintf(self::REBIND_REPORT_URL, $reportId);
            }

            $response = $this->client->request(Client::METHOD_POST, $url, ['datasetId'=>$datasetId]);

            return $this->client->generateResponse($response);
    }


    public function ExportReport($reportId, $path, $groupId=null){

        if ($groupId) {
            $url = sprintf(self::EXPORT_REPORT_IN_GROUP_URL, $groupId, $reportId);
        }else{
            $url = sprintf(self::EXPORT_REPORT, $reportId);
        }

        return $this->client->request(Client::METHOD_GET, '/stream/20', ['sink' => '/path/to/file']);
    }


}
