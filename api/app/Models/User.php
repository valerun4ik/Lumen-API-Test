<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Lumen\Auth\Authorizable;

/**
 * @property int id
 * @property string first_name
 * @property string last_name
 * @property string email
 * @property string phone
 * @property string password
 * @property string api_token
 * @property-read Company[]|null companyRelation
 *
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereEmail($value)
 *
 * @mixin Builder
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
    ];

    public function companyRelation(): HasMany
    {
        return $this->hasMany(Company::class);
    }

}
