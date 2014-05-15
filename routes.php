<?php
namespace Plugin\SitemapXml;

$sitemapUrl = ipGetOption('SitemapXml.sitemapUrl');

$routes[$sitemapUrl] = array(
    'name' => 'SitemapXml',
    'action' =>
        function() {
            $xmlResponse = new XmlResponse(null);
            return $xmlResponse;
        }
);
