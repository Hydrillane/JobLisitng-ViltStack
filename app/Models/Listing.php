<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
	use HasFactory;

	protected $fillable = [
		'name',
		'position',
		'company',
		'work_settings',
		'employment_type',
		'description',
		'salary_min',
		'salary_max'
	];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(
            \App\Models\User::class,
            'by_user_id'
        );
    }


	public function scopeFilter(Builder $query, array $filters): Builder
	{
		return $query->when(
			$filters['position'] ?? false,
			fn($query, $value) => $query->where('position', 'like', '%' . request('position') . '%')
		)
			->when(
				$filters['location'] ?? false,
				fn($query, $value) => $query->where('location', 'like', '%' . request('location') . '%')
			);
	}


	public function getDaysSinceCreatedAttribute()
	{
		return Carbon::parse($this->created_at)->diffInDays(Carbon::now());
	}


	public function getDaysSinceUpdatedAttribute()
	{
		return Carbon::parse($this->updated_at)->diffInDays(Carbon::now());
	}

	public function getFormattedSalaryRangeAttribute()
	{
		if (!$this->salary_min && !$this->salary_max) {
			return 'Salary not specified';
		}

		$formatSalary = function ($amount) {
			return number_format($amount, 2, '.', ',');
		};

		if (!$this->salary_max) {
			return 'USD ' . $formatSalary($this->salary_min) . '+ per year';
		}

		if ($this->salary_min == $this->salary_max) {
			return 'USD ' . $formatSalary($this->salary_min) . ' per year';
		}

		return 'USD ' . $formatSalary($this->salary_min) . ' - ' . $formatSalary($this->salary_max) . ' per year';
	}
}
