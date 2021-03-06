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
use app\index\model\Article as ArticleModel;
use app\index\model\Menu as MenuModel;

class Cate extends Base
{
	/**
	 * ajax加载栏目下文章
	 * @return array
	 */
	public function ajaxList()
	{
		$ArticleModel = new ArticleModel();
		$MenuModel = new MenuModel();
		$request = request();
		if($request->isAjax()){
		    if(empty($request->param('id'))){
                $start = 8 + ($request->param('lenth')-1) * 4;
                $where['art_title'] = ['like',"%".request()->param('key')."%"];
                $articles = $ArticleModel->getCateList($where,$start,4);
                if(empty($articles)){
                    return ["err"=>2,"msg"=>"没有啦!","data"=>""];
                }
                return ["err"=>0,"data"=>getAjaxHtml($articles,1),"msg"=>"数据加载完成"];
            }else{
                $where['menu_id'] = $request->param('id');
                $where['menu_parent'] = ['neq',0];
                $start = 8 + ($request->param('lenth')-1) * 4;
                $menudata = $MenuModel->where($where)->find();
                if(empty($menudata)){
                    return ["err"=>1,"msg"=>"对应的栏目不存在","data"=>""];
                }
                $articles = $ArticleModel->getCateList($where,$start,4);
                if(empty($articles)){
                    return ["err"=>2,"msg"=>"没有啦!"];
                }
                return ["err"=>0,"datas"=>getAjaxHtml($articles,1),"msg"=>"数据加载完成"];
            }


		}else{
			return ['err'=>1,'msg'=>'错误请求方式'];
		}
	}
	
    /**
     * 栏目首页
     * @return mixed
     */
    public function index()
    {
        $ArticleModel = new ArticleModel();
        $MenuModel = new MenuModel();
        $request = request();
        $where['menu_id'] = $request->param('id');
        $where['menu_parent'] = ['neq',0];
        $start = 0;
        $menudata = $MenuModel->where($where)->find();
        if(empty($menudata)){
            abort(404, '栏目不存在');
        }
        $catedata['articles'] = $ArticleModel->getCateList($where,$start,$num = 8);
        $this->assign('catedata',$catedata);
        $this->assign('title',$menudata['menu_name']);
        return $this->fetch('index');
    }

    /**
     * 文章查找
     * @return mixed
     */
    public function search()
    {
        $ArticleModel = new ArticleModel();
        $where['art_title'] = ['like',"%".request()->param('key')."%"];
        $start = 0;
        $catedata['articles'] = $ArticleModel->getCateList($where,$start,$num = 8);
        $this->assign('catedata',$catedata);
        $this->assign('title',"查询");
        return $this->fetch('index');
    }

}