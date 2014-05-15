<?php
namespace Plugin\SitemapXml;
class Model{
    public static function xmlOutput(){

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $pages = self::getAllPageIds();

        foreach ($pages as $pageId){

            $pageUrl = self::getPageUrl($pageId);

            if ($pageUrl){
                $xml .= '<url>';

                $xml .=     '<loc>';
                $xml .=    ipHomeUrl().$pageUrl;
                $xml .=     '</loc>';

                $xml .=     '<lastmod>';
                $xml .=     self::getPageLastMod($pageId);
                $xml .=     '</lastmod>';

                $xml .= '</url>';

            }
        }

        $xml .= '</urlset>';

        return $xml;
    }

    public static function getAllPageIds(){

        $pages = ipDb()->selectColumn('page', 'id', array('isDeleted' => 0, 'isDisabled' => 0, 'isSecured' =>0), 'ORDER BY `pageOrder`');

        return $pages;
    }

    public static function getPageUrl($pageId){
        return ipPage($pageId)->getUrlPath();
    }


    public static function getPageLastMod($pageId){

        $modTime = ipPage($pageId)->getUpdatedAt();
        $timestamp = strtotime($modTime);
        return date('Y-m-d', $timestamp);
    }

}