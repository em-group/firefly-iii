<?php

namespace FireflyIII\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin Eloquent
 * Class Whitelabel
 *
 * @property int $id
 * @property string $name
 * @property string $domain
 * @property boolean $active
*/
class Whitelabel extends Model
{

    public $timestamps = true;

    protected $casts = [
        'active' => 'boolean'
    ];

    public function config(): HasMany
    {
        return $this->hasMany(WhitelabelConfig::class, 'whitelabel_id', 'id');
    }
}
