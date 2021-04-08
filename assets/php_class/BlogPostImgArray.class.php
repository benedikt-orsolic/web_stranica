<?php

class BlogGeneratePostImgArray {

    private $imgList = null;

    public function __construct(string $upidStr) {

        $imgList = scandir('../../images');

        for( $i = 2; $i < count($imgList); $i++ ) {
            
            if(strcmp($upidStr, explode('-', $imgList[$i])[0]) === 0) {
                array_push($this->imgList, $imgList[$i]);
            }
        }
    }

    public function getImgArray() {
        return $this->imgList;
    }
    
    public function getFormattedImgList($imgClassList) {
        foreach($this->imgList as $img) {
            echo '<img class="' . $imgClassList . '" src="images/'. $img . '">';
        }
    }

    public function deleteImgsFromList() {
        foreach($this->imgList as $img) {
            unlink('../../images/' . $img);
        }
    }
}