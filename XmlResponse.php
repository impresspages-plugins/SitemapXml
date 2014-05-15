<?php
namespace Plugin\SitemapXml;

class XmlResponse extends \Ip\Response {

    public function __construct($data)
    {
        parent::__construct($data);
    }

    public function render()
    {
        $xml = Model::xmlOutput();
        return $xml;
    }

    public function send()
    {
        $this->addHeader('Content-type: text/xml;');
        parent::send();
    }

}