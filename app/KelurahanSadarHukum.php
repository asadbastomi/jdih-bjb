<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KelurahanSadarHukum extends Model
{
    use SoftDeletes;

    protected $table = 'kelurahan_sadar_hukum';

    protected $appends = [
        'nama_kelurahan',
        'nama_kecamatan',
        'kota',
        'alamat',
        'pos_bankum',
        'jumlah_pos',
        'keterangan',
    ];

    protected $fillable = [
        'kelurahan_id',
        'kecamatan_id',
        'latitude',
        'longitude',
        'sk_walikota_nomor',
        'sk_walikota_tanggal',
        'sk_walikota_detail',
        'sk_gubernur_nomor',
        'sk_gubernur_tanggal',
        'sk_gubernur_detail',
        'is_active',
        'status',
        'posbankum_alamat',
        'posbankum_jadwal',
        'posbankum_telepon',
        'posbankum_keterangan',
    ];

    protected $casts = [
        'sk_walikota_tanggal' => 'date',
        'sk_gubernur_tanggal' => 'date',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Relationship with Kelurahan
     */
    public function kelurahan()
    {
        return $this->belongsTo(Kelurahan::class);
    }

    /**
     * Relationship with Kecamatan
     */
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    /**
     * Relationship with AgendaKelurahan
     */
    public function agendas()
    {
        return $this->hasMany(AgendaKelurahan::class);
    }

    /**
     * Relationship with InfografisKelurahan
     */
    public function infografis()
    {
        return $this->hasMany(InfografisKelurahan::class);
    }

    /**
     * Scope to get only active records
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to search by kelurahan name
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->whereHas('kelurahan', function($q) use ($search) {
                $q->where('nama_kelurahan', 'like', "%{$search}%");
            })->orWhereHas('kecamatan', function($q) use ($search) {
                $q->where('nama_kecamatan', 'like', "%{$search}%");
            });
        }
        return $query;
    }

    /**
     * Get the nama_kelurahan attribute.
     * Returns the kelurahan name from the relationship.
     *
     * @return string|null
     */
    public function getNamaKelurahanAttribute()
    {
        if ($this->relationLoaded('kelurahan') && $this->kelurahan) {
            $nama = $this->kelurahan->nama_kelurahan;
            return is_string($nama) ? $nama : null;
        }
        
        if ($this->kelurahan_id && !$this->relationLoaded('kelurahan')) {
            $this->load('kelurahan');
            if ($this->kelurahan && $this->kelurahan->nama_kelurahan) {
                $nama = $this->kelurahan->nama_kelurahan;
                return is_string($nama) ? $nama : null;
            }
        }
        
        return null;
    }

    /**
     * Get the kota attribute.
     * Returns the city name from the kecamatan relationship.
     *
     * @return string|null
     */
    public function getKotaAttribute()
    {
        // Try direct kecamatan relationship first
        if ($this->relationLoaded('kecamatan') && $this->kecamatan) {
            $nama = $this->kecamatan->kota;
            return is_string($nama) ? $nama : null;
        }
        
        // Try nested kelurahan->kecamatan relationship
        if ($this->relationLoaded('kelurahan') && $this->kelurahan && $this->kelurahan->relationLoaded('kecamatan') && $this->kelurahan->kecamatan) {
            $nama = $this->kelurahan->kecamatan->kota;
            return is_string($nama) ? $nama : null;
        }
        
        // Try to load the direct kecamatan relationship
        if ($this->kecamatan_id && !$this->relationLoaded('kecamatan')) {
            $this->load('kecamatan');
            if ($this->kecamatan && $this->kecamatan->kota) {
                $nama = $this->kecamatan->kota;
                return is_string($nama) ? $nama : null;
            }
        }
        
        // Try to load via kelurahan
        if ($this->kelurahan_id && !$this->relationLoaded('kelurahan')) {
            $this->load('kelurahan.kecamatan');
            if ($this->kelurahan && $this->kelurahan->kecamatan && $this->kelurahan->kecamatan->kota) {
                $nama = $this->kelurahan->kecamatan->kota;
                return is_string($nama) ? $nama : null;
            }
        }
        
        return 'Banjarbaru'; // Default city
    }

    /**
     * Get the nama_kecamatan attribute.
     * Returns the kecamatan name from either the direct kecamatan relationship
     * or from the nested kelurahan->kecamatan relationship.
     *
     * @return string|null
     */
    public function getNamaKecamatanAttribute()
    {
        // Try direct kecamatan relationship first
        if ($this->relationLoaded('kecamatan') && $this->kecamatan) {
            $nama = $this->kecamatan->nama_kecamatan;
            return is_string($nama) ? $nama : null;
        }
        
        // Try nested kelurahan->kecamatan relationship
        if ($this->relationLoaded('kelurahan') && $this->kelurahan && $this->kelurahan->relationLoaded('kecamatan') && $this->kelurahan->kecamatan) {
            $nama = $this->kelurahan->kecamatan->nama_kecamatan;
            return is_string($nama) ? $nama : null;
        }
        
        // Try to load the direct kecamatan relationship
        if ($this->kecamatan_id && !$this->relationLoaded('kecamatan')) {
            $this->load('kecamatan');
            if ($this->kecamatan && $this->kecamatan->nama_kecamatan) {
                $nama = $this->kecamatan->nama_kecamatan;
                return is_string($nama) ? $nama : null;
            }
        }
        
        // Try to load via kelurahan
        if ($this->kelurahan_id && !$this->relationLoaded('kelurahan')) {
            $this->load('kelurahan.kecamatan');
            if ($this->kelurahan && $this->kelurahan->kecamatan && $this->kelurahan->kecamatan->nama_kecamatan) {
                $nama = $this->kelurahan->kecamatan->nama_kecamatan;
                return is_string($nama) ? $nama : null;
            }
        }
        
        return null;
    }

    /**
     * Get alamat attribute from relationship
     */
    public function getAlamatAttribute()
    {
        if ($this->relationLoaded('kelurahan') && $this->kelurahan) {
            $alamat = $this->kelurahan->alamat;
            return is_string($alamat) ? $alamat : null;
        }
        
        if ($this->kelurahan_id && !$this->relationLoaded('kelurahan')) {
            $this->load('kelurahan');
            if ($this->kelurahan && $this->kelurahan->alamat) {
                $alamat = $this->kelurahan->alamat;
                return is_string($alamat) ? $alamat : null;
            }
        }
        
        return null;
    }

    /**
     * Get pos_bankum attribute for compatibility (legacy field name)
     */
    public function getPosBankumAttribute()
    {
        return $this->posbankum_alamat;
    }

    /**
     * Get jumlah_pos attribute (derived from POSBANKUM data)
     */
    public function getJumlahPosAttribute()
    {
        // This can be customized based on business logic
        return $this->posbankum_alamat ? 1 : 0;
    }

    /**
     * Get keterangan attribute for compatibility (POSBANKUM keterangan)
     */
    public function getKeteranganAttribute()
    {
        return $this->posbankum_keterangan;
    }

}
