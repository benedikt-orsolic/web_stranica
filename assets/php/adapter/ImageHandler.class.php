<?php

class ImageHandler {

    const allowed_file_types = ['image/png', 'image/jpeg', 'application/pdf'];

    public function processImgFile(int $postId, int $ownerId, array $file) {

        $tmp_name = $file['tmp_name'];

        if(!is_uploaded_file($tmp_name)) return 0;
        
        $mime_type = mime_content_type($tmp_name);
        

        if(!in_array($mime_type, ImageHandler::allowed_file_types)) return 0;

        $explodeMIME = explode('/', $mime_type);
        $extension = end($explodeMIME);

        $destination = '../../images/' . $postId . '-' . $ownerId . '-' . uniqid() . '.' . $extension;

        if (move_uploaded_file ($tmp_name , $destination)) return 1;
    }
}