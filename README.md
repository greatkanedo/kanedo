## My Blog
****

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;进入Web开发有些日子了，一直想写一个内容足够丰富、界面简洁大气的个人博客，记录之余还可以选择一款陌生的框架练手，要求是足够轻量和简洁。然后就开始选择后端框架和前台模版的选择。

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;后端框架屈指可数，之前项目使用过`ThinkPHP3.1.3`和`ThinkPHP3.2.3`以及`YII1.0`和`YII2.0`，模版引擎(例如:`Smarty`)确实足够小巧灵活，但毕竟已经落后，没有公司再使用，再三挑选之后决定采用`Codeignter`作为后端框架。


&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;之后就开始利用闲暇时间使用`Codeignter`开发出这套博客系统，博客前台是在一位同为后端开发工程师的个人博客扒下来的，原博主的后端框架是使用 `Laravel` 框架开发的，在此感谢[@叶落山城秋](https://www.iphpt.com/)。后台页面我采用了`H-ui admin`，一款优秀轻量的前台框架来完成后台管理界面，功能丰富且足够简洁。

---

##### 运行环境
* **PHP5.0+**
* **Mysql5.0+**
* **Composer**


前台入口|后台入口
:--:|:--:
index.php|/login|
> 后台入口路由在`application/config/routes.php`内可自定义。

```flow                             // 流程
st=>start: 启动|past:>http://www.baidu.com[blank] // 开始
e=>end: 结束                      // 结束
op1=>operation: 方案一             // 运算1
sub2=>subroutine: 方案二|approved:>http://www.baidu.com[_parent]  // 运算2
sub3=>subroutine: 重新制定方案        // 运算2
cond1=>condition: 行不行？|request  // 判断条件1
cond2=>condition: 行不行？          // 判断条件2
io=>inputoutput: 结果满意           // 输出

// 开始->方案1->判断条件->
st->op1->cond1
// 判断条件1为no->方案2->判断条件2为no->重新制定方案->方案1
cond1(no,right)->sub2->cond2(no,right)->sub3(right)->op1
cond1(yes)->io->e       // 判断条件满足->输出->结束
cond2(yes)->io->e       // 判断条件满足->输出->结束
```
