<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\IncomingDatum
 *
 * @property int $id
 * @property int $locator_id
 * @property string $frame
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_invalid
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IncomingDatum newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IncomingDatum newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IncomingDatum query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IncomingDatum whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IncomingDatum whereFrame($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IncomingDatum whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IncomingDatum whereIsInvalid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IncomingDatum whereLocatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\IncomingDatum whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class IncomingDatum extends Model
{
    //
}
