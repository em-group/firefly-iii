<?php

declare(strict_types=1);

namespace FireflyIII\Repositories\Whitelabel;

use FireflyIII\Models\Whitelabel;
use Illuminate\Support\Collection;

interface WhitelabelRepositoryInterface
{

    public function all(): Collection;

    public function count(): int;

    public function deactivate(Whitelabel $whitelabel): bool;

    public function activate(Whitelabel $whitelabel): bool;

    public function findByName(string $name): ?Whitelabel;

    public function findByDomain(string $domain): ?Whitelabel;

    public function config(Whitelabel $whitelabel): Collection;

    public function store(array $data): Whitelabel;

    public function update(Whitelabel $whitelabel, array $data): Whitelabel;
}