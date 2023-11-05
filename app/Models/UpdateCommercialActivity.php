<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UpdateCommercialActivity extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'commercial_activity_id',
        'seasons',
        'activity_id',
        'seller_id',
        'sector_id',
        'specialization_id',
        'social_accounts',
        'work_days',
        'type',
        'address',
        'description',
        'status',
        'reason',
        'logo',
        'commercial_register',
        'commercial_signature',
        'commercial_number'
    ];
    public function sector(): BelongsTo
    {
        return $this->belongsTo(Sector::class, 'sector_id');
    }


    public function updateCommercial(): HasOne
    {
        return $this->hasOne(UpdateCommercialActivity::class, 'commercial_activity_id');
    }
    public function seasons(): array
    {
        foreach (json_decode($this->seasons) as $key => $season) {
            $item = Season::findOrfail($season)->getName();
            $array[] = $item;
        }
        return $array;
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }

    public function speciality(): BelongsTo
    {
        return $this->belongsTo(Speciality::class, 'specialization_id');
    }
    public function workDays(): array
    {
        $array = [];
        if ($this->work_days) {
            foreach (json_decode($this->work_days) as $key => $item) {
                $day = Day::findOrfail($item->day)->getName();
                $array[] = data_set($item, 'day', $day);
            }
        }

        return $array;
    }
}
