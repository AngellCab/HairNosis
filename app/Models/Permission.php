<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Role;

class Permission extends Model
{
    /**
	 * The database uses softDeletes.
	 *
	 */
    use HasFactory, RecordSignature, SoftDeletes;

    /**
	 * The fields that have dates and need Carbon instances
	 *
	 * @var array
	 */
    protected $dates = ['deleted_at'];

    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
    protected $fillable = [
        'name',
        'label',
        'description'
    ];

    /**
	 * Get  Permissions roles
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function roles() {
        
        return $this->belongsToMany(Role::class)->withPivot('modby', 'createdby')->withTimestamps();
    }
}
