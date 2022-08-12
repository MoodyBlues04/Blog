<?php

namespace app\models;

use yii\base\Model;

class SearchForm extends Model
{

    /** @var string $textInput input data */
    public $textInput;

    public function rules()
    {
        return [
            [['textInput'], 'safe'],
        ];
    }

    /**
     * Returns tags as array
     * @return array|false if there are nothing tags
     */
    public function getTagsAsArray() {
        $tags = explode('#', $this->textInput);
        array_shift($tags);
        if (!empty($tags)) {
            return $tags;
        }
        return false;
    }
}