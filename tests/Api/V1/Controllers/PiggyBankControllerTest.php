<?php
/**
 * PiggyBankControllerTest.php
 * Copyright (c) 2018 thegrumpydictator@gmail.com
 *
 * This file is part of Firefly III.
 *
 * Firefly III is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Firefly III is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Firefly III. If not, see <http://www.gnu.org/licenses/>.
 */

declare(strict_types=1);

namespace Tests\Api\V1\Controllers;

use Exception;
use FireflyIII\Models\TransactionCurrency;
use FireflyIII\Repositories\Account\AccountRepositoryInterface;
use FireflyIII\Repositories\Currency\CurrencyRepositoryInterface;
use FireflyIII\Repositories\PiggyBank\PiggyBankRepositoryInterface;
use FireflyIII\Transformers\PiggyBankTransformer;
use Laravel\Passport\Passport;
use Log;
use Mockery;
use Tests\TestCase;

/**
 *
 * Class PiggyBankControllerTest
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class PiggyBankControllerTest extends TestCase
{
    /**
     * Set up test
     */
    public function setUp(): void
    {
        parent::setUp();
        Passport::actingAs($this->user());
        Log::info(sprintf('Now in %s.', get_class($this)));
    }

    /**
     * @covers \FireflyIII\Api\V1\Controllers\PiggyBankController
     * @throws Exception
     */
    public function testStore(): void
    {
        // create stuff
        $piggy = $this->user()->piggyBanks()->first();

        // mock stuff:
        $repository  = $this->mock(PiggyBankRepositoryInterface::class);
        $transformer = $this->mock(PiggyBankTransformer::class);

        // mock calls to transformer:
        $transformer->shouldReceive('setParameters')->withAnyArgs()->atLeast()->once();
        $transformer->shouldReceive('setCurrentScope')->withAnyArgs()->atLeast()->once()->andReturnSelf();
        $transformer->shouldReceive('getDefaultIncludes')->withAnyArgs()->atLeast()->once()->andReturn([]);
        $transformer->shouldReceive('getAvailableIncludes')->withAnyArgs()->atLeast()->once()->andReturn([]);
        $transformer->shouldReceive('transform')->atLeast()->once()->andReturn(['id' => 5]);

        // mock calls:
        $repository->shouldReceive('setUser');
        $repository->shouldReceive('store')->once()->andReturn($piggy);

        $data = [
            'name'          => 'New piggy #' . $this->randomInt(),
            'account_id'    => 1,
            'target_amount' => '100',
        ];

        // test API
        $response = $this->post(route('api.v1.piggy_banks.store'), $data, ['Accept' => 'application/json']);
        $response->assertStatus(200);
        $response->assertJson(['data' => ['type' => 'piggy_banks', 'links' => true],]);
        $response->assertHeader('Content-Type', 'application/vnd.api+json');

    }

    /**
     * @covers \FireflyIII\Api\V1\Controllers\PiggyBankController
     * @throws Exception
     */
    public function testStoreNull(): void
    {
        // mock stuff:
        $repository = $this->mock(PiggyBankRepositoryInterface::class);

        // mock calls:
        $repository->shouldReceive('setUser');
        $repository->shouldReceive('store')->once()->andReturn(null)->once();


        $data = [
            'name'          => 'New piggy #' . $this->randomInt(),
            'account_id'    => 1,
            'target_amount' => '100',
        ];

        // test API
        Log::warning('The following error is part of a test.');
        $response = $this->post(route('api.v1.piggy_banks.store'), $data, ['Accept' => 'application/json']);
        $response->assertStatus(500);
        $response->assertHeader('Content-Type', 'application/json');
        $response->assertSee('Could not store new piggy bank.');

    }

    /**
     * @covers \FireflyIII\Api\V1\Controllers\PiggyBankController
     * @throws Exception
     */
    public function testUpdate(): void
    {
        // create stuff
        $piggy = $this->user()->piggyBanks()->first();

        // mock stuff:
        $repository    = $this->mock(PiggyBankRepositoryInterface::class);
        $accountRepos  = $this->mock(AccountRepositoryInterface::class);
        $currencyRepos = $this->mock(CurrencyRepositoryInterface::class);
        $transformer   = $this->mock(PiggyBankTransformer::class);

        // mock calls to transformer:
        $transformer->shouldReceive('setParameters')->withAnyArgs()->atLeast()->once();
        $transformer->shouldReceive('setCurrentScope')->withAnyArgs()->atLeast()->once()->andReturnSelf();
        $transformer->shouldReceive('getDefaultIncludes')->withAnyArgs()->atLeast()->once()->andReturn([]);
        $transformer->shouldReceive('getAvailableIncludes')->withAnyArgs()->atLeast()->once()->andReturn([]);
        $transformer->shouldReceive('transform')->atLeast()->once()->andReturn(['id' => 5]);


        // mock calls:
        $repository->shouldReceive('setUser');

        $repository->shouldReceive('update')->once()->andReturn($piggy);

        $repository->shouldReceive('getCurrentAmount')->andReturn('12');
        $repository->shouldReceive('getSuggestedMonthlyAmount')->andReturn('12');

        //$accountRepos->shouldReceive('setUser');
        $accountRepos->shouldReceive('getMetaValue')->withArgs([Mockery::any(), 'currency_id'])->andReturn('1');

        $currencyRepos->shouldReceive('setUser');
        $currencyRepos->shouldReceive('findNull')->withArgs([1])->andReturn($this->getEuro());

        $data = [
            'name'          => 'new pigy bank ' . $this->randomInt(),
            'account_id'    => 1,
            'target_amount' => '100',
        ];

        // test API
        $response = $this->put(route('api.v1.piggy_banks.update', [$piggy->id]), $data, ['Accept' => 'application/json']);
        $response->assertStatus(200);
        $response->assertJson(['data' => ['type' => 'piggy_banks', 'links' => true],]);
        $response->assertHeader('Content-Type', 'application/vnd.api+json');
    }


}
