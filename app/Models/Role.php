<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Permission;
use App\Models\User;
use Auth;


class Role extends Model
{
    /**
	 * The database uses softDeletes.
	 *
	 */
    use HasFactory, SoftDeletes, RecordSignature;

    /**
	 * The fields that have dates and need Carbon instances
	 *
	 * @var array
	 */
    protected  $dates = ['deleted_at'];

    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
    protected $fillable = [
        'name',
        'label'
    ];

    /**
	 * Get Role Permissions
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function permissions() {

        return $this->belongsToMany(Permission::class)
            ->withPivot('modby', 'createdby')->withTimestamps();
    }

    /**
	 * Set an array of permissions
	 *
	 * @param $permission_list
	 *
	 */
    public function assignPermissions($permission_list) {

        if (!is_null($permission_list)) {
            $pivotData = array_fill(0, count($permission_list), [
                'modby'     => Auth::id(), 
                'createdby' => Auth::id()
            ]);
            $syncData  = array_combine($permission_list, $pivotData);

            $this->permissions()->sync($syncData);
        } else {
            $this->permissions()->detach();
        }
    }

    /**
	 * Helper Class to give permissions to role
	 *
	 * @param Permission $permission
	 * @return array
	 */
    public function givePermissionTo(Permission $permission) {

        return $this->permissions()->save($permission);
    }

    /**
	 * Get an array of id of permisos associated with user
	 *
	 * @return array
	 */
    public function getPermissionListAttribute() {

        return $this->permissions->pluck('id')->all();
    }

    /**
     * relation with table users
     * 
     * @return User
     */
    public function users() {

        return $this->belongsToMany(User::class);
    }
}
