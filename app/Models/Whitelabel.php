<?php

namespace FireflyIII\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @mixin Eloquent
 * Class Whitelabel
 *
 * @property int $id
 * @property string $name
 * @property string $domain
 * @property boolean $active
 *
 * @property WhitelabelConfig[]|Collection $config
*/
class Whitelabel extends Model
{

    public $timestamps = true;

    protected $casts = [
        'active' => 'boolean'
    ];

    protected $fillable = [
        'name', 'domain', 'active'
    ];

    public function config(): HasMany
    {
        return $this->hasMany(WhitelabelConfig::class, 'whitelabel_id', 'id');
    }

    public static function routeBinder(string $value): Whitelabel
    {
        $id = (int)$value;
        $whitelabel = self::find($id);
        if ($whitelabel !== null) {
            return $whitelabel;
        }

        throw new NotFoundHttpException;
    }
}
