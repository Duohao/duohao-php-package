<?php
namespace Duohao\Helpers;

class RequestHelper
{

    public static function post($url, $postdata, $headerString)
    {
        $postdata = http_build_query($postdata);
        $opts = array('http' => array(
            'method' => 'POST',
            'header' => $headerString,
            'content' => $postdata,
        ));
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
        return $result;
    }

}
