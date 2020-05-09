<?php
/**
 * Helper String
 */
class HelpInternet
{

    // random key
    public static function YoutubeCode( $url ) {
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/",
                                                        $url, $matches);
        return  $matches[1];
    }


    public static function VimeoCode( $url ) {

        return (int) substr(parse_url($url, PHP_URL_PATH), 1);
    }

}

