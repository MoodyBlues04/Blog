# Chat project
- [Chat project](#chat-project)
    - [Plans to implement:](#plans-to-implement)
    - [Some fix tips:](#some-fix-tips)
### Plans to implement:

* user authentication and authorization
* chat on the pusher api or web hooks
* and other functions that bring the application closer to the functionality of the messenger

### Some fix tips:

* if confirm raises the following exception: "foreach argument must be array, string given", add the following to the app/vendor/yiisoft/yii2/db/BaseActiveRecord, method getOldPrimaryKey: 'if (!is_array($keys)) {$keys = array($keys);}'

