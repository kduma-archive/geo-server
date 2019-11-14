<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use KDuma\Eloquent\Uuidable;

/**
 * App\Locator
 *
 * @property int $id
 * @property string $uuid
 * @property string|null $name
 * @property string|null $imei
 * @property string|null $ccid
 * @property int|null $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\IncomingData[] $IncomingData
 * @property-read int|null $incoming_data_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Position[] $Positions
 * @property-read int|null $positions_count
 * @property-read \App\User|null $User
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locator query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locator whereCcid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locator whereGuid($guid)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locator whereImei($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locator whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locator whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locator whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Locator whereUuid($value)
 * @mixin \Eloquent
 */
class Locator extends Model
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

    public function IncomingData()
    {
        return $this->hasMany(IncomingData::class);
    }
}
