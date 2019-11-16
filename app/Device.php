<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use KDuma\Eloquent\Uuidable;

/**
 * App\Device
 *
 * @property int $id
 * @property string $uuid
 * @property string|null $name
 * @property string|null $imei
 * @property string|null $ccid
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DataFrame[] $DataFrames
 * @property-read int|null $data_frames_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Position[] $Positions
 * @property-read int|null $positions_count
 * @property-read \App\User|null $User
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereCcid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereGuid($guid)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereImei($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereUuid($value)
 * @mixin \Eloquent
 */
class Device extends Model
{
    use Uuidable;

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Positions()
    {
        return $this->hasMany(Position::class);
    }

    public function DataFrames()
    {
        return $this->hasMany(DataFrame::class);
    }
}
