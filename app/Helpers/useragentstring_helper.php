<?php
if (! function_exists('isMobileDevice')) {
    function isMobileDevice()
    {
        $agent = service('request')->getUserAgent();
        return $agent->isMobile();
        // return preg_match(
        //     "/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos|iP(hone|od|ad))/i",
        //     $_SERVER["HTTP_USER_AGENT"]
        // );
    }
}
