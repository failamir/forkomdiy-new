<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DataKerjaSama extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'data_kerja_samas';

    protected $appends = [
        'lampiran',
    ];

    protected $dates = [
        'mulai_kerjasama',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama_stakeholder',
        'jangkauan_kerjasama',
        'jenis_kerjasama',
        'mulai_kerjasama',
        'frekuensi_kerjasama',
        'no_hp_wa_lembaga',
        'kontak_di_lembaga',
        'no_hp_wa_stakeholder',
        'nama_lembaga_kerjasama',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
        'level_id',
        'prov',
        'kab',
        'kec',
        'desa',
        'user_id'
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getLampiranAttribute()
    {
        return $this->getMedia('lampiran');
    }

    public function getMulaiKerjasamaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setMulaiKerjasamaAttribute($value)
    {
        $this->attributes['mulai_kerjasama'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
