<?php

namespace app\admin\model;

use plugin\admin\app\model\Base;

/**
 * 
 *
 * @property integer $id 主键(主键)
 * @property string $emoji 表情
 * @property string $name 转盘名称
 * @property string $created_at 创建时间
 * @property string $updated_at 更新时间
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \app\admin\model\TurntableOptions> $options
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Turntable newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Turntable newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Turntable query()
 * @property string $device_id 设备ID
 * @mixin \Eloquent
 */
class Turntable extends Base
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wa_turntable';

    protected $fillable = [
        'emoji',
        'name',
        'device_id',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    public function options()
    {
        return $this->hasMany(TurntableOptions::class, 'turntable_id', 'id');
    }
    
    
    
}
