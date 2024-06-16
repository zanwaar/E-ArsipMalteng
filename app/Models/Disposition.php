<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Disposition extends Model
{
    use HasFactory;

    protected $fillable = [
        'penerima',
        'batas_waktu',
        'content',
        'note',
        'status_dokument',
        'dokument_id',
        'user_id'
    ];

    protected $appends = [
        'formatted_batas_waktu',
    ];
    protected $table = 'disposisi';
    public function getFormattedBatasWaktuAttribute(): string
    {
        return Carbon::parse($this->batas_waktu)->isoFormat('dddd, D MMMM YYYY');
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
                ->orWhere('content', 'LIKE', '%' . $find . '%')
                ->orWhere('to', 'LIKE', $find . '%');
        });
    }

    public function scopeRender($query, Letter $letter, $search)
    {
        $pageSize = Config::code(\App\Enums\Config::PAGE_SIZE)->first();
        return $query
            ->with(['user', 'status', 'letter'])
            ->search($search)
            ->when($letter, function ($query, $letter) {
                return $query
                    ->where('dokument_id', $letter->id);
            })
            ->latest('created_at')
            ->paginate($pageSize->value)
            ->appends([
                'search' => $search,
            ]);
    }
    public function scopeNotif($query, Letter $letter, $search)
    {
        $pageSize = Config::code(\App\Enums\Config::PAGE_SIZE)->first();
        return $query
            ->with(['user', 'status', 'letter'])
            ->search($search)
            ->when($letter, function ($query, $letter) {
                return $query
                    ->where('dokument_id', $letter->id);
            })
            ->latest('created_at');
           
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
    public function status(): BelongsTo
    {
        return $this->belongsTo(LetterStatus::class, 'status_dokument', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function letter(): BelongsTo
    {
        return $this->belongsTo(Letter::class, 'dokument_id', 'id');
    }
}
