<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Class Distribucion
 *
 * @package App\Models
 * @mixin \Eloquent
 * @property int $id
 * @property int $empalde_id
 * @property int $cp
 * @property float $lat
 * @property float $lon
 * @property int $in
 * @property int $out
 * @property int $con
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Distribucion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Distribucion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Distribucion query()
 * @method static \Illuminate\Database\Eloquent\Builder|Distribucion whereCon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribucion whereCp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribucion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribucion whereEmpaldeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribucion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribucion whereIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribucion whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribucion whereLon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribucion whereOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Distribucion whereUpdatedAt($value)
 */
	class Distribucion extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Empalme
 *
 * @property int $id
 * @property int $cp
 * @property float $lat
 * @property float $lon
 * @property int $in
 * @property int $out
 * @property int $con
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Empalme newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Empalme newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Empalme query()
 * @method static \Illuminate\Database\Eloquent\Builder|Empalme whereCon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empalme whereCp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empalme whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empalme whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empalme whereIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empalme whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empalme whereLon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empalme whereOut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empalme whereUpdatedAt($value)
 */
	class Empalme extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

