<?php

namespace app\models;

use app\objects\imgbbApi;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadImgForm extends Model
{
    /** @var UploadedFile */
    public $imageFile;

    // public function rules()
    // {
    //     return [
    //         [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => ['png', 'jpg']],
    //     ];
    // }
    
    /**
     * Uploads file by api and add link to DB
     * 
     * @return string|null 
     */
    public function upload()
    {
        if ($this->validate()) {
            $path = __DIR__ . '/../uploads/';
            if (!is_dir($path)) {
                mkdir($path);
            }
            $path .= $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($path);

            $this->imageFile->tempName = $path;
            $return = imgbbApi::uploadImg($this->imageFile);

            unlink($path);

            return $return['data']['url'];
        } else {
            return null;
        }
    }
}