<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int user_id
 * @property string recover_token
 * @property bool expired
 *
 * @property-read User userRelation
 *
 * @method static Builder|RecoverPasswords whereUserId($value)
 * @method static Builder|RecoverPasswords whereRecoverToken($value)
 * @method static Builder|RecoverPasswords whereExpired($value)
 *
 * @mixin Builder
 */
class RecoverPasswords extends Model
{
    protected $fillable = [
        'user_id',
    ];

    public function userRelation(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
