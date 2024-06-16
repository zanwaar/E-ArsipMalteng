<?php

namespace App\Models;

use App\Enums\LetterType;
use App\Enums\Config as ConfigEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Letter extends Model
{
    use HasFactory;


    /**
     * @var string[]
     */
    protected $fillable = [
        'nomor_dokument',
        'nomor_agenda',
        'pengirim',
        'penerima',
        'bidang',
        'tgl_dokument',
        'tgl_diterima',
        'description',
        'note',
        'type',
        'klasifikasi_kode',
        'user_id',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'tgl_dokument' => 'date',
        'tgl_diterima' => 'date',
    ];

    protected $appends = [
        'formatted_tgl_dokument',
        'formatted_tgl_diterima',
        'formatted_created_at',
        'formatted_updated_at',
    ];
    protected $table = 'dokument';
    public function getFormattedTgldokumentAttribute(): string
    {
        return Carbon::parse($this->tgl_dokument)->isoFormat('dddd, D MMMM YYYY');
    }

    public function getFormattedTglDiterimaAttribute(): string
    {
        return Carbon::parse($this->tgl_diterima)->isoFormat('dddd, D MMMM YYYY');
    }

    public function getFormattedCreatedAtAttribute(): string
    {
        return $this->created_at->isoFormat('dddd, D MMMM YYYY, HH:mm:ss');
    }

    public function getFormattedUpdatedAtAttribute(): string
    {
        return $this->updated_at->isoFormat('dddd, D MMMM YYYY, HH:mm:ss');
    }

    public function scopeType($query, LetterType $type)
    {
        return $query->where('type', $type->type());
    }

    public function scopeIncoming($query)
    {
        return $this->scopeType($query, LetterType::INCOMING);
    }

    public function scopeOutgoing($query)
    {
        return $this->scopeType($query, LetterType::OUTGOING);
    }
    public function scopeBidang($query)
    {
        return $this->scopeType($query, LetterType::BIDANG);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', now());
    }

    public function scopeYesterday($query)
    {
        return $query->whereDate('created_at', now()->addDays(-1));
    }

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query, $find) {
            return $query
                ->where('nomor_dokument', $find)
                ->orWhere('nomor_agenda', $find)
                ->orWhere('pengirim', 'LIKE', $find . '%')
                ->orWhere('penerima', 'LIKE', $find . '%');
        });
    }

    public function scopeRender($query, $search)
    {
        return $query
            ->with(['attachments', 'classification'])
            ->search($search)
            ->latest('tgl_dokument')
            ->paginate(Config::getValueByCode(ConfigEnum::PAGE_SIZE))
            ->appends([
                'search' => $search,
            ]);
    }

    public function scopeAgenda($query, $since, $until, $filter)
    {
        return $query
            ->when($since && $until && $filter, function ($query, $condition) use ($since, $until, $filter) {
                return $query->whereBetween(DB::raw('DATE(' . $filter . ')'), [$since, $until]);
            });
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function classification(): BelongsTo
    {
        return $this->belongsTo(Classification::class, 'klasifikasi_kode', 'code');
    }

    /**
     * @return HasMany
     */
    public function dispositions(): HasMany
    {
        return $this->hasMany(Disposition::class, 'dokument_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(Attachment::class, 'dokument_id', 'id');
    }
}
