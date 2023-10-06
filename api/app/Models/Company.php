<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property int user_id
 * @property string title
 * @property string phone
 * @property string description
 *
 * @method static Builder|Company whereUserId($value)
 * @method static Builder|Company whereTitle($value)
 *
 * @mixin Builder
 */
class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'phone',
        'description',
    ];

}
