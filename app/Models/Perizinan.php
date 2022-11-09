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

class Perizinan extends Model implements HasMedia
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use InteractsWithMedia;
    use HasFactory;

    public $table = 'perizinans';

    protected $appends = [
        'lampiran_file',
    ];

    protected $dates = [
        'tanggal_dikeluarkan',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'instansi_penerbit',
        'nomor_izin',
        'nama_izin',
        'tanggal_dikeluarkan',
        'berlaku_sampai',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function perizinanDataLembagas()
    {
        return $this->hasMany(DataLembaga::class, 'perizinan_id', 'id');
    }

    public function getLampiranFileAttribute()
    {
        return $this->getMedia('lampiran_file');
    }

    public function getTanggalDikeluarkanAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setTanggalDikeluarkanAttribute($value)
    {
        $this->attributes['tanggal_dikeluarkan'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
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
