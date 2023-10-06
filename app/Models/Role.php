<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $nom
 * @property string $created_at
 * @property string $updated_at
 * @property UserRole[] $userRoles
 */
class Role extends Model
{
    /**
     * @var array
     */
    
    protected $fillable = ['id', 'created_at', 'updated_at', 'nom'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }
}
