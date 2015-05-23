<?php
namespace Plugin\SitemapXml;
class Model{
    public static function xmlOutput(){

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $pages = self::getAllPageIds();

        foreach ($pages as $pageId){

            $page = ipPage($pageId);
            if (!$page) {
                continue;
            }

            $xml .= '<url>';

            $xml .=     '<loc>';
            $xml .=    $page->getLink();
            $xml .=     '</loc>';

            $xml .=     '<lastmod>';
            $xml .=     date('Y-m-d', strtotime($page->getUpdatedAt()));
            $xml .=     '</lastmod>';

            $xml .= '</url>';

        }

        $xml .= '</urlset>';

        return $xml;
    }

    public static function getAllPageIds(){

        $pages = ipDb()->selectColumn('page', 'id', array('isDeleted' => 0, 'isDisabled' => 0, 'isSecured' =>0), 'ORDER BY `pageOrder`');

        return $pages;
    }





}
