<?php

namespace app\api\controller;

use app\admin\model\Turntable;
use app\api\basic\Base;
use support\Request;

class TurntableController extends Base
{
    function add(Request $request)
    {
        $emoji = $request->post('emoji');
        $name = $request->post('name');
        $device_id = $request->post('device_id');
        $options = $request->post('options');//[{"name":"xxxx","weigh":"xxxx","hide_weigh":"xxxx"}]
        $turntable = Turntable::create([
            'emoji'=>$emoji,
            'name'=>$name,
            'device_id'=>$device_id,
        ]);
        $turntable->options()->createMany($options);
        // 使用 fresh 刷新模型及其关联数据
        $turntable = $turntable->fresh('options');

        return $this->success('添加成功', $turntable);
    }


    function edit(Request $request)
    {
        $id = $request->post('id');
        $emoji = $request->post('emoji');
        $name = $request->post('name');
        $device_id = $request->post('device_id');
        $options = $request->post('options');//[{"name":"xxxx","weigh":"xxxx","hide_weigh":"xxxx"}]
        $turntable = Turntable::find($id);
        if (!$turntable) {
            return $this->fail('转盘不存在');
        }
        $turntable->emoji = $emoji;
        $turntable->name = $name;
        $turntable->device_id = $device_id;
        $turntable->save();
        $turntable->options()->delete();
        $turntable->options()->createMany($options);
        return $this->success('修改成功');
    }





}
