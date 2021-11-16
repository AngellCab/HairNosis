<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\HasRoles;
use App\Roles;
use Session;
use Auth;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, RecordSignature, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'view_report',
        'hash'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relation with company
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function company() {

        return $this->belongsToMany(Company::class, 'role_user')
            ->withPivot('company_id', 'location_id')
            ->withTimestamps();
    }

    /**
     * Relation with branch
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function branches() {
        
        return $this->belongsToMany(Location::class, 'role_user')
            ->withPivot('company_id', 'location_id')
            ->withTimestamps();
    }

    /**
     * User has many roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles() {

        return $this->belongsToMany(Role::class)
            ->withPivot('company_id', 'location_id', 'modby')
            ->withTimestamps();
    }

    /**
     * Set an array of roles
     *
     * @param $role_list
     */
    public function assignRoles($company_id, $location_list, $role_list) {

        $this->roles()->detach();
        $this->branches()->detach();

        if ($location_list) {
            foreach($location_list as $location_id) {
                if (!is_null($role_list)) {
                    
                    /**
                     * Se llena un arreglo de 0 a el tamaño de agencias con el valor del moduser
                     * y la location. Se combinan con las id de agencia y se añaden
                     * @var  $pivotData
                     */
                    $pivotData = array_fill(0, count($role_list), [
                        'modby'       => (is_null(Auth::id())) ? $this->id : Auth::id(),
                        'location_id' => $location_id,
                        'company_id'  => $company_id
                    ]);

                    $syncData = array_combine($role_list, $pivotData);
                    $this->roles()->attach($syncData);
                }
            }
        }
    }

    /**
     * Get an array of id of permisos associated with user
     *
     * @return array
     */
    public function getRoleListAttribute() {

        return $this->roles->pluck('id')->all();
    }

    /**
     * Get an array of id of companies associated with user
     *
     * @return array
     */
    public function getCompanyListAttribute() {
        
        return $this->companies->pluck('id')->all();
    }

    /**
     * Role SUPERADMIN
     * 
     * @return Boolean isSuperAdmin
     */
    public function isSuperAdmin() {

        if ($this->hasRole('super_admin') || $this->isRoot()) {
            return true;
        }

        return false;
    }

    /**
     * Role ADMIN
     * 
     * @return Boolean isAdmin
     */
    public function isAdmin() {

        if ($this->hasRole('admin')) {
            return true;
        }

        return false;
    }

    /**
     * Role MANAGER
     * 
     * @return Boolean isManager
     */
    public function isManager() {

        if ($this->hasRole('manager')) {
            return true;
        }

        return false;
    }

    /**
     * Role STYLIST
     * 
     * @return Boolean isStylist
     */
    public function isStylist() {

        if ($this->hasRole('stylist')) {
            return true;
        }

        return false;
    }

    public function scopeStylists($query) {

        return $query->whereHas('roles', function($query) {
            $query->where('id', Roles::STYLIST);
        })->whereHas('company', function($query) {
            $query->where('id', Session::get('company_id'));
        });
    }
}
