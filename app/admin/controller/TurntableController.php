<?php

namespace app\admin\controller;

use support\Request;
use support\Response;
use app\admin\model\Turntable;
use plugin\admin\app\controller\Crud;
use support\exception\BusinessException;

/**
 * 转盘模板管理 
 */
class TurntableController extends Crud
{
    
    /**
     * @var Turntable
     */
    protected $model = null;

    /**
     * 构造函数
     * @return void
     */
    public function __construct()
    {
        $this->model = new Turntable;
    }
    
    /**
     * 浏览
     * @return Response
     */
    public function index(): Response
    {
        return view('turntable/index');
    }

    /**
     * 插入
     * @param Request $request
     * @return Response
     * @throws BusinessException
     */
    public function insert(Request $request): Response
    {
        if ($request->method() === 'POST') {
            return parent::insert($request);
        }
        return view('turntable/insert');
    }

    /**
     * 更新
     * @param Request $request
     * @return Response
     * @throws BusinessException
    */
    public function update(Request $request): Response
    {
        if ($request->method() === 'POST') {
            return parent::update($request);
        }
        return view('turntable/update');
    }

}
