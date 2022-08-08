<?php

namespace app\objects;

class imgbbApi
{
    const API_KEY = '86e67330ae3e2aa64d5486ad51cb9636';

    /**
     * Upload image to imgbb,
     * returns response array or string error
     * 
     * @param UploadedFile $image
     * 
     * @return array|string
     */
    public static function uploadImg($image)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.imgbb.com/1/upload?key='. self::API_KEY);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        $file_name = $image->name;
        $data = array('image' => base64_encode(file_get_contents($image->tempName)), 'name' => $file_name);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return 'Error:' . curl_error($ch);
        }else{
            return json_decode($result, true);
        }
        curl_close($ch);
    }
}