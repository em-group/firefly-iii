<?php
/**
 * Created by PhpStorm.
 * User: zifle
 * Date: 2019-07-08
 * Time: 3:58 PM
 */

namespace FireflyIII\Repositories\Whitelabel;


use FireflyIII\Models\Whitelabel;
use FireflyIII\Models\WhitelabelConfig;
use Illuminate\Support\Collection;

class WhitelabelRepository implements WhitelabelRepositoryInterface
{

    public function __construct()
    {
        if ('testing' === config('app.env')) {
            Log::warning(sprintf('%s should not be instantiated in the TEST environment!', get_class($this)));
        }
    }

    public function all(): Collection
    {
        return Whitelabel::orderBy('id', 'ASC')->get(['whitelabels.*']);
    }

    public function count(): int
    {
        return $this->all()->count();
    }

    public function deactivate(Whitelabel $whitelabel): bool
    {
        return $whitelabel->update([
            'active' => 0
        ]);
    }

    public function activate(Whitelabel $whitelabel): bool
    {
        return $whitelabel->update([
            'active' => 1
        ]);
    }

    public function findByName(string $name): ?Whitelabel
    {
        return Whitelabel::where('name', $name)->first();
    }

    public function findByDomain(string $domain): ?Whitelabel
    {
        return Whitelabel::where('domain', $domain)->first();
    }

    public function config(Whitelabel $whitelabel): Collection
    {
        return $whitelabel->config()->get();
    }

    public function store(array $data): Whitelabel
    {
        $whitelabel = Whitelabel::create(
            [
                'name' => $data['name'],
                'domain' => $data['domain'],
                'active' => $data['active'] ?? false
            ]
        );
        return $whitelabel;
    }

    public function update(Whitelabel $whitelabel, array $data): Whitelabel
    {
        $whitelabel->name = $data['name'] ?? $whitelabel->name;
        $whitelabel->domain = $data['domain'] ?? $whitelabel->domain;
        $whitelabel->active = $data['active'] ?? false;
        $whitelabel->save();

        if (!empty($data['config']['name'])) {
            $l = count($data['config']['name']);

            $existing = [];
            $configs = [];
            for ($i = 0; $i < $l; $i++) {
                $c = [
                    'whitelabel_id' => $whitelabel->id,
                    'name' => $data['config']['name'][$i],
                    'value' => $data['config']['value'][$i]
                ];
                $existing[] = $c['name'];
                $configs[] = $c;
            }

            // Delete any non-existing configs
            $whitelabel->config()->whereNotIn('name', $existing)->delete();
            foreach ($configs as $config) {
                $c = WhitelabelConfig::firstOrNew([
                    'whitelabel_id' => $config['whitelabel_id'],
                    'name' => $config['name']
                ]);
                $c->value = $config['value'];
                $c->save();
            }
        } else {
            // If the config array is empty, no configs should be set!
            $whitelabel->config()->delete();
        }

        return $whitelabel;
    }
}