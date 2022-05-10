<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $age
 * @property bool $active
 */
class User extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'age', 'active'];
}
