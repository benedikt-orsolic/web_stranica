<?php
if( isset( $_FILES['imgUpload']) ) {
    echo ( $_FILES['imgUpload']['type'][0]);
}