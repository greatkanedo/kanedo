## My Blog
****

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;进入Web开发有些日子了，一直想写一个内容足够丰富、界面简洁大气的个人博客，后端框架足够轻量精炼。

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;市面上流行的后端框架屈指可数，之前项目使用过`ThinkPHP3.1.3`和`ThinkPHP3.2.3`以及`YII1.0`和`YII2.0`，这些框架对于个人博客来说都过于厚重，模版引擎(例如:`Smarty`)确实足够小巧灵活，但毕竟已经落后，没有公司再使用，想到之前在外包公司曾经使用过Codeignter给前台做接口，Codeignter小巧灵活，中小项目都能够得心应手，再三挑选之后决定采用`Codeignter`作为后端框架。

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;博客前台是在一位同为后端开发工程师的个人博客扒下来的，原博主的后端框架是使用 `Laravel` 框架开发的，在此感谢[@叶落山城秋](https://www.iphpt.com/)。

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;后台页面我采用了`H-ui admin`，一款优秀轻量的前台框架来完成后台管理界面，功能丰富且足够简洁。


### 集成
| 名称          |
|:-------------: |
| Codeignter 5.1 |
| H-ui admin 3.1 |
| 皮肤来自: [叶落山城秋](https://www.iphpt.com/) |
| Qiniu SDK 7.1.3 |
| Web uploader |


### 运行环境
* **PHP5.0+**
* **Mysql5.0+**
* **Composer**


### 入口
前台入口|后台入口
:--:|:--:
index.php|/login|
> 后台入口路由在`application/config/routes.php`内可自定义。


### 功能及进度

| 名称          |           进展         |      详情       |
|:-------------: |:--------------:| :-------------------:|
| ~~博文发布~~ | ~~已完成~~ |  | 
| ~~文章分类~~ | ~~已完成~~ |  |
| ~~多级分类~~ | ~~已完成~~ |  |
| ~~图片上传~~ | ~~已完成~~ | 配合七牛云存储 |
| ~~前台渲染~~ | ~~已完成~~ | |
| ~~多说评论~~ | ~~已完成~~ |  |
| i18n | 暂时搁置 |  |
| ~~文章详情~~ | ~~已完成~~ | |

<a href="https://github.com/you"><img style="position: absolute; top: 0; left: 0; border: 0;" src="https://s3.amazonaws.com/github/ribbons/forkme_left_darkblue_121621.png" alt="Fork me on GitHub"></a>
