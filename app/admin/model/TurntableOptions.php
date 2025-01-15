<?php

namespace app\admin\model;

use plugin\admin\app\model\Base;

/**
 *
 *
 * @property int $id 主键
 * @property int $turntable_id 模板
 * @property string $name 名称
 * @property int $weigh 显示权重
 * @property int $hide_weigh 隐藏权重
 * @property \Illuminate\Support\Carbon|null $created_at 创建时间
 * @property \Illuminate\Support\Carbon|null $updated_at 更新时间
 * @property-read \app\admin\model\Turntable|null $turntable
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TurntableOptions newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TurntableOptions newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|TurntableOptions query()
 * @mixin \Eloquent
 */
class TurntableOptions extends Base
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wa_turntable_options';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = [
        'turntable_id',
        'name',
        'weigh',
        'hide_weigh',
    ];


    function turntable()
    {
        return $this->belongsTo(Turntable::class, 'turntable_id', 'id');
    }
}