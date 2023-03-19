<?php

namespace Utils;

use CurlHandle;

/**
 * Made by hand
 * 
 * @author RasyidMF 
*/
class Http
{
    private CurlHandle $instance;
    private array $data = [];
    private array $headers = [];
    
    private function setOption($opt, $value) {
        return curl_setopt($this->instance, $opt, $value);
    }

    public function __construct($url)
    {
        $this->instance = curl_init($url);
        $this->setOption(CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * Adding the form data
    */
    public function data(array $data) {
        $this->data = array_merge($this->data, $data);
        return $this;
    }

    /**
     * Setting the header request
    */
    public function header(array $headers) {
        $this->headers = array_merge($this->headers, $headers);
        return $this;
    }

    /**
     * Adding the file form data
    */
    public function file(string $filename, string $key) {
        $this->data = array_merge($this->data, [
            $key => curl_file_create($filename)
        ]);
        return $this;
    }

    /**
     * Setup the http request into post method
    */
    public function post() {
        $this->setOption(CURLOPT_POST, 1);
        return $this;
    }

    /**
     * Execute the http request
    */
    public function execute() {
        $this->setOption(CURLOPT_POSTFIELDS, $this->data);
        $this->setOption(CURLOPT_HTTPHEADER, $this->headers);

        $result = curl_exec($this->instance);
        curl_close($this->instance);

        return $result;
    }
    
}