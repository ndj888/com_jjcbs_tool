## 简介：
个人常用工具类封装phar包

## Vesion
The Project release version v0.1.

### use composer
composer require ndj888/com_jjcbs_tool


# 注解
为了提高编程效率，开始采用注解模式，解决注入POPO解耦。

#使用注解
###注解方法：
定义注解需实现于com_jjcbs\lib\AnnotationMethodAbstract，例：
ex;
```
    namespace com_jjcbs\lib\annotation;
    
    
    use com_jjcbs\exceptions\AnnotationException;
    use com_jjcbs\fun\AnnotationFun;
    use com_jjcbs\lib\AnnotationMethodAbstract;
    
    /**
     * format of type json serialize
     * Class OutPutFormat
     * @package com_jjcbs\lib\annotation
     */
    class OutPutFormat extends AnnotationMethodAbstract
    {
        static protected function parsedMethod($data = null)
        {
            // TODO: Implement parsedMethod() method.
            self::parseMethodExec($data);
        }
    
        static protected function parsedClass($data = null)
        {
            // TODO: Implement parsedClass() method.
            return 'disable';
        }
    
        static protected function parsedVar($data = null)
        {
            // TODO: Implement parsedVar() method.
            $getterStr = AnnotationFun::createGetterByVar(self::$argv['varName'] , $data);
            self::$input = str_replace('//{{annotation placeholder}}' , $getterStr , self::$input);
        }
    
        static protected function do()
        {
            // TODO: Implement do() method.
            switch (self::$param['type']){
                case 'json':
                    if(isset(self::$argv['varName'])) return sprintf('return json_decode($this->%s , true);' , self::$argv['varName']);
                    if(isset(self::$argv['methodName'])) return 'return json_decode(%s , true)';
                    break;
                default:break;
    
            }
        }
    
        static protected function exception(AnnotationException $exception)
        {
            // TODO: Implement exception() method.
            // no thing
            return ;
        }
    
    
    }
```
###使用注解
```$xslt

    /**
     * @@OutPutFormat(type="json")
     * @return array
     */
    public function getJson(){
        return $this->getArr();
    }
```
所有注解推荐定义以@@注释开始，如@@OutPutFormat()
### 注解的作用范围
1. 作用于成员变量的注解
    
    ```
            /**
             * @@com_jjcbs\lib\annotation\OutPutFormat(type="json")
             * @var string
             */
            private $type = '123';
    ```
    
2. 作用于成员方法的注解

    ```
    /**
     * @@OutPutFormat(type="json")
     * @return array
     */
    public function getJson(){
        return $this->getArr();
    }
    ```
3. 作用于类的注解

```$xslt
/**
 * @@Service()
 * Class TestServiceAnnotation
 * @package com_jjcbs\test\resource\scan
 */
class TestServiceAnnotation
{
    public function testGetInfo(){
        return 'hellow world';
    }
}
```
### 编译注解
推荐自行实现编译小工具
ex:
```
// 创建以文件试编译注解驱动
$annotationFileCacheDriver = new \com_jjcbs\lib\drivers\AnnotationFileCacheDriverImpl();
//获取配置单例，设置配置
$annotationConfig = \com_jjcbs\lib\ServiceFactory::getInstance(\com_jjcbs\service\AnnotationConfigServiceImpl::class);
\com_jjcbs\lib\conf\AnnotationConfig::setData([
    // the alias map
    // 设置别名映射，方便使用短名称，否则需要使用命名空间全名注解方法
    'alias' => [
        'Service' => Service::class,
        'Rpc' => Rpc::class,
        'OutPutFormat' => OutPutFormat::class
    ],
    // These annotations will be scanning
    // 所有composer psr-4定义的autoload命名空间将被扫描
    // These annotations will be scanning
    'scanNamespace' => [
        "com_jjcbs\\" => "src/com_jjcbs/"
    ],
    // 项目根目录
    'appPath' => COM_JJCBS_ROOT_PATH,
    // build 目录注意 /
    'buildPath' => COM_JJCBS_ROOT_PATH . '/build/'
]);
    // 扫描编译注解
$annotationFileCacheDriver->scanNamespacesFiles();    
```
编译成完得到build目录，替换原有composer命名空间即可工作。