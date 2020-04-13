# Laravel 多场景验证器

[![Php Version](https://img.shields.io/badge/php-%3E=7.3-brightgreen.svg?maxAge=2592000)](https://packagist.org/packages/inhere/php-validate)
[![Laravel Version](https://img.shields.io/badge/laravel-%3E=6.0-brightgreen.svg?maxAge=2592000)](https://packagist.org/packages/inhere/php-validate)
## 安装

您可以通过composer安装软件包:

```bash
composer require lazy/validate
```
## 使用
接下来我们来验证一个文章的提交信息，首先我们新建一个文章验证类 ArticleValidate.php 并填充一些内容
```php
<?php
namespace App\Validate;

use App\Validate\BaseValidate;
/**
 * 文章验证器
 */
class ArticleValidate extends BaseValidate {
    //验证规则
    protected $rule =[
        'id'=>'required',
        'title' => 'required|max:255',
        'content' => 'required',
    ];
    //自定义验证信息
    protected $message = [
        'id.required'=>'缺少文章id',
        'title.required'=>'请输入title',
        'title.max'=>'title长度不能大于 255',
        'content.required'=>'请输入内容',
    ];

    //自定义场景
    protected $scene = [
        'add'=>"title,content",
        'edit'=> ['id','title','content'],
    ];
}
```
如上所示，在这个类中我们定义了验证规则 rule，自定义验证信息 message，以及验证场景 scene
### 非场景验证
我们只需要定义好规则
```php
public function update(){

        $ArticleValidate = new ArticleValidate;

        $request_data = [
            'id'=>'1',
            'title'=>'我是文章的标题',
            'content'=>'我是文章的内容',
        ];

        if (!$ArticleValidate->check($request_data)) {
           var_dump($ArticleValidate->getError());
        }

    }
```
check 方法中总共有四个参数，第一个要验证的数据，第二个验证规则，第三个自定义错误信息，第四个验证场景，其中 2，3，4 非必传。
如果验证未通过我们调用 getError() 方法来输出错误信息，getError()暂不支持返回所有验证错误信息 。

### 场景验证
我们需要提前在验证类中定义好验证场景
如下，支持使用字符串或数组，使用字符串时，要验证的字段需用 , 隔开
```php
//自定义场景
    protected $scene = [
        'add'=>"title,content",
        'edit'=> ['id','title','content'],
    ];
```

然后在我们的控制器进行数据验证

```php
//自定义场景
public function add(){

        $ArticleValidate = new ArticleValidate;

        $request_data = [
            'title'=>'我是文章的标题',
            'content'=>'我是文章的内容',
        ];

        if (!$ArticleValidate->scene('add')->check($request_data)) {
           var_dump($ArticleValidate->getError());
        }

    }
```

## 控制器内验证
   当然我们也允许你不创建验证类来验证数据
   ```php
$Validate = new BaseValidate;
   
           $request_data = [
               'title'=>'我是文章的标题',
               'content'=>'我是文章的内容',
           ];
   
           $rule =[
               'id'=>'required',
               'title' => 'required|max:255',
               'content' => 'required',
           ];
           //自定义验证信息
           $message = [
               'id.required'=>'缺少文章id',
               'title.required'=>'请输入title',
               'title.max'=>'title长度不能大于 255',
               'content.required'=>'请输入内容',
           ];
   
           if (!$Validate->check($request_data,$rule,$message)) {
              var_dump($Validate->getError());
           }
   ```
