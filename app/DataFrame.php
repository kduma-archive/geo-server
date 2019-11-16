<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DataFrame
 *
 * @property int $id
 * @property int $device_id
 * @property string $frame
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool $is_invalid
 * @property-read \App\Device $Device
 * @property-read \App\Position $Position
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DataFrame newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DataFrame newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DataFrame query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DataFrame whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DataFrame whereDeviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DataFrame whereFrame($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DataFrame whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DataFrame whereIsInvalid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DataFrame whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DataFrame extends Model
{
    public function Device()
    {
        return $this->belongsTo(Device::class);
    }
    
    public function Position()
    {
        return $this->hasOne(Position::class);
    }
}
