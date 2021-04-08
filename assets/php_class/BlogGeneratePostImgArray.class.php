<?php

class BlogGeneratePostImgArray {


    private function __construct() {
    }

    public static function getImgUrlArray(string $upidStr, string $imgId, string $imgClassList) {

        $imgList = scandir('../../images');

        for( $i = 2; $i < count($imgList); $i++ ) {
            
            if(strcmp($upidStr, explode('-', $imgList[$i])[0]) === 0) {
                echo '<img id="' . $imgId . '" class="' . $imgClassList . '" src="images/'. $imgList[$i] . '">';
            }
        }
    }
}