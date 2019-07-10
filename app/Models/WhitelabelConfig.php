<?php

namespace FireflyIII\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Eloquent
 * Class WhitelabelConfig
 *
 * @property int $whitelabel_id
 * @property string $name
 * @property string $value
*/
class WhitelabelConfig extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'whitelabel_id', 'name'
    ];

    public function whitelabel(): BelongsTo
    {
        return $this->belongsTo(Whitelabel::class, 'whitelabel_id', 'id');
    }

    public function getValueAttribute($value)
    {
        return json_decode($value);
    }

    public function setValueAttribute($value): void
    {
        $this->attributes['value'] = json_encode($value);
    }
}
