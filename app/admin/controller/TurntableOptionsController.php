<?php

namespace app\admin\controller;

use support\Request;
use support\Response;
use app\admin\model\TurntableOptions;
use plugin\admin\app\controller\Crud;
use support\exception\BusinessException;
use Webman\Push\Api;

/**
 * 选项 
 */
class TurntableOptionsController extends Crud
{
    
    /**
     * @var TurntableOptions
     */
    protected $model = null;

    /**
     * 构造函数
     * @return void
     */
    public function __construct()
    {
        $this->model = new TurntableOptions;
    }

    /**
     * 查询
     * @param Request $request
     * @return Response
     * @throws BusinessException
     */
    public function select(Request $request): Response
    {
        [$where, $format, $limit, $field, $order] = $this->selectInput($request);
        $query = $this->doSelect($where, $field, $order)->with(['turntable']);
        return $this->doFormat($query, $format, $limit);
    }
    
    /**
     * 浏览
     * @return Response
     */
    public function index(): Response
    {
        return view('turntable-options/index');
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
        return view('turntable-options/insert');
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
            $hide_weigh = $request->post('hide_weigh');
            $id = $request->post('id');
            $row = $this->model->find($id);
            if ($row->hide_weigh != $hide_weigh && !empty($row->turntable->device_id)){
                $api = new Api(
                    'http://127.0.0.1:3233',
                    config('plugin.webman.push.app.app_key'),
                    config('plugin.webman.push.app.app_secret')
                );

                $api->trigger('private-'.$row->turntable->device_id, 'edit',[
                    'id' => $id,
                    'turntable_id' => $row->turntable_id,
                    'hide_weigh' => $hide_weigh,
                ]);
            }
            return parent::update($request);
        }
        return view('turntable-options/update');
    }

}
