
<?php
if (! function_exists('imageLinkType')) {
    function imageLinkType(string $link)
    {
        switch (true) {
            case ($link == null):
                return '<img src="" alt="">';
                break;
            case (strpos($link, 'youtube') > 0):
                return '<iframe src= https://www.youtube.com/embed/' . urlParamExtractor($link, 'v') . 'title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
                break;
            case (strpos($link, 'drive.google.com') > 0):
                $gid = explode('/', $link)[5];
                return "<img src=https://lh3.googleusercontent.com/d/$gid=w640 />";
                break;
            case ($link != null):
                return "<img src=$link/>";
                break;
        }
    }
}
if (! function_exists('urlParamExtractor')) {
    function urlParamExtractor(string $url, string $parameter)
    {
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);
        return $params[$parameter];
    }
}
