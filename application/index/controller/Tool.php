<?php
// +----------------------------------------------------------------------
// | 青春博客 thinkphp5 版本
// +----------------------------------------------------------------------
// | Copyright (c) 2013~2016 http://loveteemo.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: long <admin@loveteemo.com>
// +----------------------------------------------------------------------
namespace app\index\controller;
use app\index\controller\Base;

class Tool extends Base
{
    /**
     * 工具箱首页
     * @return mixed
     */
    public function index()
    {
        return $this->fetch();
    }

    /**
     * 工具箱调度
     * @return mixed
     */
    public function info()
    {
        $view = request()->param("str");
        return $this->fetch($view);
    }

}