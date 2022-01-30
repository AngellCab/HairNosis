<?php

namespace App\Models;

// use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use Laravel\Sanctum\HasApiTokens;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Models\Appointment;
use App\Models\Services;
use App\Models\Location;

class Client extends Authenticatable
{
    /**
	 * The database uses softDeletes.
	 *
	 */
    use HasApiTokens, HasFactory, RecordSignature, SoftDeletes, Notifiable;

    /**
	 * The fields that have dates and need Carbon instances
	 *
	 * @var array
	 */
    protected $dates = ['deleted_at'];

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
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'origin',
        'email_verified_at',
        'password',
        'hash'
    ];

    /**
     * Relation with location table 
     *
     */
    public function appointments() {

        return $this->belongsTo(Appointment::class);
    }

    /**
     * Relation with services table
     * 
     * 
     */
    public function services() {

        return $this->belongsTo(Service::class);
    }

    public function scopeCompany($query, $company_id) {

        $branches = Location::where('company_id', $company_id)->pluck('id');
        return $query->whereHas('appointments', function($query) use ($branches) {
            $query->whereIn('location_id', $branches);
        });
    }
}
