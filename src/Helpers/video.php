<?php

if (! function_exists('getYoutubeId')) {
    function getYoutubeId($url)
    {
        $regex = "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/";

        if (preg_match($regex, $url, $matches)) {
            return $matches[1];
        }
    }
}

if (! function_exists('getVimeoId')) {
    function getVimeoId($url)
    {
        $regex = "/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/";

        if (preg_match($regex, $url, $matches)) {
            return $matches[5];
        }
    }
}

if (! function_exists('getVideoProvider')) {
    function getVideoProvider($url)
    {
        if (! is_null(getYoutubeId($url))) {
            return 'youtube';
        }

        return 'vimeo';
    }
}
