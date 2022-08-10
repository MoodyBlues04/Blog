<?php

namespace app\models;

use yii\base\Model;

class ArticleForm extends Model
{
    /** @var string $header */
    public $header;

    /** @var string $content */
    public $content;

    /** @var string|null $tags */
    public $tags;

    public function rules() {
        return [
            [['header', 'content'], 'required', 'message' => 'please fill in header and content'],
            [['tags'], 'validateTags', 'message' => 'Incorrect tags format.'],
        ];
    }

    /**
     * Loads form data to database
     * 
     * @return bool
     */
    public function upload() {
        $model = new Article();
        $model->user_id = \Yii::$app->user->identity->id;
        $model->header = $this->header;
        $model->content = $this->content;

        $tags = explode('#', $this->tags);
        array_shift($tags);
        $model->tags = json_encode($tags, JSON_UNESCAPED_UNICODE);
        $model->created_at = date('Y-m-d H:i:s');
        return $model->save();
    }

    /**
     * Validates tags
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateTags($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $tags = explode('#', $this->tags);
            array_shift($tags);
            foreach ($tags as $tag) {
                if (!ctype_alnum($tag)) {
                    $this->addError($attribute, 'Incorrect tags format.');
                    return;
                }
            }
        }
    }
}