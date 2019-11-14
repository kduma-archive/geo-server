<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use KDuma\Eloquent\Uuidable;

/**
 * App\Position
 *
 * @property int $id
 * @property string $uuid
 * @property int $locator_id
 * @property int $incoming_data_id
 * @property string|null $time
 * @property float|null $latitude
 * @property float|null $longitude
 * @property float|null $altitude
 * @property float|null $speed
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_from_gsm
 * @property-read \App\IncomingData $IncomingData
 * @property-read \App\Locator $Locator
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereAltitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereGuid($guid)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereIncomingDataId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereIsFromGsm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereLatitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereLocatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereLongitude($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereSpeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Position whereUuid($value)
 * @mixin \Eloquent
 */
class Position extends Model
{
    use Uuidable;

    public function Locator()
    {
        return $this->belongsTo(Locator::class);
    }

    public function IncomingData()
    {
        return $this->belongsTo(IncomingData::class);
    }
}
