<?php

namespace DecibelSDK;

require_once 'InternalUtilities.php';
require_once 'DecibelException.php';

class Decibel {
    private $_appId;
    private $_appKey;

    /**
     * Create a new instance of the Decibel class with your credentials.
     * This is the main class that all queries are run through
     *
     * @param $appId string Your Decibel App Id
     * @param $appKey string Your Decibel App Key
     */
    public function __construct($appId, $appKey){
        $this->_appId = $appId;
        $this->_appKey = $appKey;
    }

    private function run($queryStr){
        // Check that a query string was provided
        if(!isset($queryStr))
            return null;
        // Initialize the cURL session with the request URL
        $session = curl_init(InternalUtilities::BASEURL . str_replace(" ", "%20", $queryStr));
        curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
        $headers = array(
            'DecibelAppID: ' . $this->_appId,
            'DecibelAppKey: ' . $this->_appKey,
            'DecibelTimestamp: ' . date('Ymd H:i:s', time()),
        );
        curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
        // Execute cURL on the session handle
        $response = curl_exec($session);
        return $response;
    }

    public function executeAlbumsQuery(AlbumsQuery $query){
        try{
            $resultJson = $this->run($query->getQueryString());
            if($resultJson == null)
                throw new DecibelException("No data returned by the Decibel API.");

            return new AlbumsQueryResult($resultJson);
        }
        catch(\Exception $ex){
            throw new DecibelException($ex->getMessage());
        }
    }

    public function executeAlbumsByIdQuery(AlbumsByIdQuery $query){
        try{
            $resultJson = $this->run($query->getQueryString());
            if($resultJson == null)
                throw new DecibelException("No data returned by the Decibel API.");

            return new AlbumsByIdQueryResult($resultJson);
        }
        catch(\Exception $ex){
            throw new DecibelException($ex->getMessage());
        }
    }

    public function executeRecordingsQuery(RecordingsQuery $query){
        try{
            $resultJson = $this->run($query->getQueryString());
            if($resultJson == null)
                throw new DecibelException("No data returned by the Decibel API.");

            return new RecordingsQueryResult($resultJson);
        }
        catch(\Exception $ex){
            throw new DecibelException($ex->getMessage());
        }
    }

    public function executeRecordingsByIdQuery(RecordingsByIdQuery $query){
        try{
            $resultJson = $this->run($query->getQueryString());
            if($resultJson == null)
                throw new DecibelException("No data returned by the Decibel API.");

            return new RecordingsByIdQueryResult($resultJson);
        }
        catch(\Exception $ex){
            throw new DecibelException($ex->getMessage());
        }
    }

    public function executeArtistsQuery(ArtistsQuery $query){
        try{
            $resultJson = $this->run($query->getQueryString());
            if($resultJson == null)
                throw new DecibelException("No data returned by the Decibel API.");

            return new ArtistsQueryResult($resultJson);
        }
        catch(\Exception $ex){
            throw new DecibelException($ex->getMessage());
        }
    }

    public function executeArtistsByIdQuery(ArtistsByIdQuery $query){
        try{
            $resultJson = $this->run($query->getQueryString());
            if($resultJson == null)
                throw new DecibelException("No data returned by the Decibel API.");

            return new ArtistsByIdQueryResult($resultJson);
        }
        catch(\Exception $ex){
            throw new DecibelException($ex->getMessage());
        }
    }

}
