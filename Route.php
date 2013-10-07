<?php 
    abstract class RouterAbstract {
         public abstract function getRoute($request);
    }

    /**
    * 路由器
    */
    class Router extends RouterAbstract{
        //+?的意思匹配一次或多次，但尽量少重复 abcabc 只会获取abc
        const REGEX_ANY = "([^/]+?)";
        const REGEX_INT = "([0-9]+?)";
        const REGEX_ALPHA = "([a-zA-Z_-]+?)";
        const REGEX_ALPHANUMERIC = "([0-9a-zA-Z_-]+?)";
        const REGEX_STATIC = "%s";

        protected $routes = array();
        protected $baseUrl = '';

        //设定基本的url
        public function setBaseUrl($baseUrl)
        {
            $this->baseUrl = preg_quote($baseUrl,'@');
        }

        //添加路由
        public function addRoute($route,$option=array())
        {
            $this->routes[] = array('pattern'=>$this->_parseRoute($route),
                'option'=>$option);
        }

        //解析路由的正则表达式
        private function _parseRoute($route)
        {
            $baseUrl = $this->baseUrl;
            if ($route == '/') {
                //如果是根目录则直接返回
                return "@^$baseUrl/$@";
            }

            //分割
            $parts = explode("/", $route);
            $regex = "@^$baseUrl";

            if ($route[0] == "/") {
                //如果字符串的第一值是'/'，则扔掉
                array_shift($parts);
            }

            foreach ($parts as $part) {
                $regex .= "/";
                $args = explode(":", $part);
                if (sizeof($args) == 1) {
                    //如果只有一个值参数则为自定义正则表达式,preg_quote转码
                    $regex .= sprintf(self::REGEX_STATIC,
                        preg_quote(array_shift($args),'@'));
                    continue;
                } elseif ($args[0] == '') {
                    //如果第一个只为空，扔掉，类型设置为false,表示没有类型
                    array_shift($args);
                    $type = false;
                } else {
                    //第一个值为类型
                    $type = array_shift($args);
                }

                //获得对应正则值
                $key = array_shift($args);
                if ($type == "regex") {
                    $regex .= $key;
                    continue;
                }

                //去除不符合的字符
                $this->normalize($key);

                //给匹配结果命名
                $regex .= '(?P<'.$key.'>';
                switch (strtolower($type)) {
                    case 'int':
                    case 'integer':
                        $regex .= self::REGEX_INT;
                        break;
                    case 'alpha':
                        $regex .= self::REGEX_ALPHA;
                        break;
                    case 'alphanumeric':
                    case 'alphanum':
                    case 'alnum':
                        $regex .= self::REGEX_ALPHANUMERIC;
                        break;
                    default:
                        $regex .= self::REGEX_ANY;
                        break;
                }
                $regex .= ")";
            }
            $regex .= '$@u';
            return $regex;
        }

        public function getRoute($request)
        {
            $matches = array();
            foreach ($this->routes as $route) {
                if (preg_match($route['pattern'],$request,$matches)) {
                    //获得匹配结果，如果key为int型，数据则不能用
                    foreach ($matches as $key => $value) {
                        if (is_int($key)) {
                            unset($matches[$key]);
                        }
                    }

                    $result = $matches + $route['option'];
                    return $result;
                }
            }
        }

        public function normalize(&$param)
        {
            $param = preg_replace("/[^0-9a-zA-Z]/", "", $param);
        }
    }
 ?>