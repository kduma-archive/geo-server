<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\IncomingData
 *
 * @property int $id
 * @property int $locator_id
 * @property string $frame
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Locator $Locator
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IncomingData newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IncomingData newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IncomingData query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IncomingData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IncomingData whereFrame($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IncomingData whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IncomingData whereLocatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IncomingData whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class IncomingData extends Model
{

    public function Locator()
    {
        return $this->belongsTo(Locator::class);
    }
}
