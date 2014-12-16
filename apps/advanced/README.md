以下只是个人意见，哥只是个俗人，难免有疏漏，如果建议，欢迎提出...
===

代码未测试，bug难免
---

我给核心框架取了个名字叫Kiwi(猕猴桃)，话说弄个有节操的名字，不太好找，这个还是比较靠谱的
---

核心框架代码放在kiwi目录下，主要用于扩展Yii的功能，目录结构和Yii的对应，config文件夹放了通用配置文件，需要在index.php中实例化Yii时合并到config中
---

Kiwi.php
---
上帝类，用于生成所有model，所有的model的create都不能用new

比如 $user = new User() 不允许，应该用 $user = Kiwi::getUser() 代替

Kiwi内部会调用 Yii::createObject($type, array $params = []) 生成类的实例


Module.php
---
Kiwi模块的Module类，Kiwi作为Yii的一个module来管理加载所有其他module

kiwi\Module.php
---
其他模块的Module.php的类应继承该类，在该类实例化是会加载classMap, controllerMap, viewPath的定义和模块升级

普通module定义
---
目录结构

    作者名or组织名
    
        module名
        
            controllers     控制器，不解释
            
            migrations      所有的数据库安装脚本放这边，写法跟Yii的migration写法一样，区别是命名规则应类似：
                            初始安装 文件名 v0.1.0.php, 类名 class v0_1_0 extends extends Migration
                            升级 文件名 v0.1.0_v0.2.0.php, 类名 class v0_1_0_v0_2_0 extends extends Migration
                            因为类名必须以字母开头，且不能出现.和- 所以...
            
            models/         主要用于数据库操作，不解释
                  
            service/        主要业务逻辑，不解释
            
            views/          视图，不解释
            
            Module.php      模块初始化类，在类中需要定义 public $version, 用于版本升级，其他与Yii一致
            
            classes.php     定义class映射表，如 user => common\models\User, 用于 $user = Kiwi::getUser() 生成 common\models\User 的实例
                            
执行流程
---
在main-common.php的配置文件中将kiwi\Module设置为启动时初始化，Yii在实例化后会调用 kiwi\Module 的 bootstrap($app) 函数

该函数调用 $this->initModuleNamespace(); 遍历其他module目录设定Alias,及命名空间用于类的autoload

之后调用 $app->setModules($this->getModuleConfig()); $this->getModuleConfig() 用于获取 '@common/config/modules', '@app/config/modules' 文件夹下的module定义。之后将配置存入Yii实例中

之后调用 $app->initModules(); 由于Yii使用延时加载Module，所以Module的实例化会在第一次使用时执行，所以当没有显示调用 Yii::$app->getModule('xxx') 时, 模块类不会初始化，
但是模块下的controllerMap, view/theme/pathMap和classes用于整个程序的重写，需要在第一时间载入，所以在 kiwi\Module 中调用初始化所有模块


现有问题
---
在定义classes.php用于重写model时，多个模块都重写了同一个model时，及其载入顺序问题，后载入会覆盖前面的

使用controllerMap用于重写控制器时，多个载入及顺序问题，权限控制问题，权限控制基于actionFilter时，是基于module, controller, action判断权限，重写后module, controller变化，会失去权限