<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Regency extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'regencies';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id_province',
        'id_regency',
        'regency_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function regencyDataDaerahs()
    {
        return $this->hasMany(DataDaerah::class, 'regency_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
