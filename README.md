# Blog project
- [Blog project](#blog-project)
    - [Plans to implement:](#plans-to-implement)
    - [Some fix tips:](#some-fix-tips)
### Plans to implement:

* user authentication and authorization
* user profile with his posts and tags
* collapsed blog post feed
* by clicking go to the full version of the article
* search articles by tags

### Some fix tips:

* if confirm raises the following exception: "foreach argument must be array, string given", add the following to the app/vendor/yiisoft/yii2/db/BaseActiveRecord, method getOldPrimaryKey: 'if (!is_array($keys)) {$keys = array($keys);}'

