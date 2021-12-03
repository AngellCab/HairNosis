<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
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
        'location_id',
        'stylist_id',
        'hash'
    ];

    /**
     * Relation with location table 
     *
     */
    public function location() {

        return $this->belongsTo('App\Models\Location');
    }

    public function scopeCompany($query, $company_id) {

        return $query->whereHas('location', function($query) use ($company_id) {
            $query->where('company_id', $company_id);
        });
    }
}
