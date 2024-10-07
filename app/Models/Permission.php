<?php

namespace App\Models;

use Database\Factories\PermissionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Summary of Permission
 */
class Permission extends Model
{
    /** @use HasFactory<PermissionFactory>  */
    use HasFactory;
    protected $fillable = ['nom'];
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
