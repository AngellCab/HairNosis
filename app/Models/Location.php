<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
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
        'phone',
        'email',
        'address',
        'manager_id',
        'company_id',
        'hash'
    ];

    /**
     * Relation with company
     * 
     */
    public function company() {

        return $this->belongsTo('App\Models\Company');
    }

    public function scopeFromCompany($query, $company_id) {

        return $query->whereCompanyId($company_id);
    }
}
