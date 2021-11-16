<?php

namespace App;

use App\Models\Role;

trait HasRoles {

    /**
     * Check If user has Role
     *
     */
    public function hasRole($role) {
        if (is_string($role)) {
            return $this->roles->contains('name',$role);
        }
        
        return ! ! $role->intersect($this->roles)->count();
    }

    public function assignRole($role) {
        return $this->roles()->save(
            Role::whereRoleName( $role )->firstOrFail()
        );
    }

    public function isRoot() {
        if ($this->id == 1) {
            return true;
        }
    }
}