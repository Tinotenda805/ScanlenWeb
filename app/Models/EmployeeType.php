<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class EmployeeType extends Model
{
    use SoftDeletes;

    protected $fillable = ['uuid', 'name', 'description'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($employee_type) {
            if (empty($employee_type->uuid)) {
                $employee_type->uuid = Str::uuid();
            }
        });
    }

    // In EmployeeType.php model
    public function ourPeople()
    {
        return $this->hasMany(OurPeople::class, 'employee_type_id');
    }


    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'uuid'; 
    }
}
