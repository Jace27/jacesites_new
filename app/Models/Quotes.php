<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Quotes
 *
 * @property int $id
 * @property string|null $author
 * @property string $quote
 * @property \Illuminate\Support\Carbon|null $showed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Quotes newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quotes newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Quotes query()
 * @method static \Illuminate\Database\Eloquent\Builder|Quotes whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quotes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quotes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quotes whereQuote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quotes whereShowedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Quotes whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Quotes extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $fillable = [
        'author',
        'quote',
        'showed_at',
    ];
    protected $casts = [
        'showed_at' => 'datetime:Y-m-d H:i:s',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public static function getNext()
    {
        $quotes = Quotes::query()
            ->whereNot('showed_at', '=', Quotes::query()->max('showed_at'))
            ->orWhereNull('showed_at')
            ->get();
        $quote = $quotes[rand(0, count($quotes) - 1)];
        $quote->update([ 'showed_at' => date('Y-m-d H:i:s', time()) ]);

        return $quote->quote;
    }
}
