<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Contracts\Translation\TranslatorTrait;

/**
 *
 *
 * @property int $id
 * @property string $nom
 * @property string $description
 * @property int $is_accessible_salarie
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|motif newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|motif newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|motif query()
 * @method static \Illuminate\Database\Eloquent\Builder|motif whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|motif whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|motif whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|motif whereIsAccessibleSalarie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|motif whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|motif whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class motif extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function absences()
    {
        return $this->hasMany(Absence::class);
    }
}
