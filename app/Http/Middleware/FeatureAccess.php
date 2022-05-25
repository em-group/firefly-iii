<?php

declare(strict_types=1);

namespace FireflyIII\Http\Middleware;

use Closure;
use Diglactic\Breadcrumbs\Breadcrumbs as BreadcrumbsManager;
use EM\Hub\Library\SubProducts;
use FireflyIII\Repositories\User\UserRepositoryInterface;
use FireflyIII\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class FeatureAccess
{

    public static $levels = [
        self::level_basic,
        self::level_premium
    ];

    const level_basic = [
        'features' => [
        ]
    ];

    const level_premium = [
        'features' => [
            'bills',
            'categories',
            'tags',
            'import',
            'piggybank',
            'rules',
            'recurring',
        ]
    ];

    const features = [
        'accounts' => [
            'name' => 'Accounts',
            'route' => '/accounts',
            'class' => [
                'FireflyIII\Http\Controllers\Account\CreateController',
                'FireflyIII\Http\Controllers\Account\DeleteController',
                'FireflyIII\Http\Controllers\Account\EditController',
                'FireflyIII\Http\Controllers\Account\IndexController',
                'FireflyIII\Http\Controllers\Account\ReconcileController',
                'FireflyIII\Http\Controllers\Account\ShowController',
            ]
        ],
        'bills' => [
            'name' => 'Bills',
            'route' => '/bills',
            'class' => 'FireflyIII\Http\Controllers\BillController'
        ],
        'budgets' => [
            'name' => 'Budgets',
            'route' => '/budgets',
            'class' => [
                'FireflyIII\Http\Controllers\Budget\AmountController',
                'FireflyIII\Http\Controllers\Budget\CreateController',
                'FireflyIII\Http\Controllers\Budget\DeleteController',
                'FireflyIII\Http\Controllers\Budget\EditController',
                'FireflyIII\Http\Controllers\Budget\IndexController',
                'FireflyIII\Http\Controllers\Budget\ShowController',
            ]
        ],
        'categories' => [
            'name' => 'Categories',
            'route' => '/categories',
            'class' => [
                'FireflyIII\Http\Controllers\Category\CreateController',
                'FireflyIII\Http\Controllers\Category\DeleteController',
                'FireflyIII\Http\Controllers\Category\EditController',
                'FireflyIII\Http\Controllers\Category\IndexController',
                'FireflyIII\Http\Controllers\Category\NoCategoryController',
                'FireflyIII\Http\Controllers\Category\ShowController'
            ]
        ],
        'tags' => [
            'name' => 'Tags',
            'route' => '/tags',
            'class' => 'FireflyIII\Http\Controllers\TagController'
        ],
        'reports' => [
            'name' => 'Reports',
            'route' => '/reports',
            'class' => [
                'FireflyIII\Http\Controllers\Report\AccountController',
                'FireflyIII\Http\Controllers\Report\BalanceController',
                'FireflyIII\Http\Controllers\Report\BillController',
                'FireflyIII\Http\Controllers\Report\BudgetController',
                'FireflyIII\Http\Controllers\Report\CategoryController',
                'FireflyIII\Http\Controllers\Report\ExpenseController',
                'FireflyIII\Http\Controllers\Report\OperationsController',
            ]
        ],
        'import' => [
            'name' => 'Import',
            'route' => '/import',
            'class' => [
                'FireflyIII\Http\Controllers\Import\CallbackController',
                'FireflyIII\Http\Controllers\Import\IndexController',
                'FireflyIII\Http\Controllers\Import\JobConfigurationController',
                'FireflyIII\Http\Controllers\Import\JobStatusController',
                'FireflyIII\Http\Controllers\Import\PrerequisitesController',
            ],
            'routes' => [
                'create/file',
                'create/bunq',
                'create/spectre',
                'create/ynap',
                'create/fints'
            ]
        ],
        'transactions' => [
            'name' => 'Transactions',
            'route' => '/transactions',
            'class' => [
                'FireflyIII\Http\Controllers\Transaction\BulkController',
                'FireflyIII\Http\Controllers\Transaction\ConvertController',
                'FireflyIII\Http\Controllers\Transaction\CreateController',
                'FireflyIII\Http\Controllers\Transaction\DeleteController',
                'FireflyIII\Http\Controllers\Transaction\EditController',
                'FireflyIII\Http\Controllers\Transaction\IndexController',
                'FireflyIII\Http\Controllers\Transaction\LinkController',
                'FireflyIII\Http\Controllers\Transaction\MassController',
                'FireflyIII\Http\Controllers\Transaction\ShowController',
            ]
        ],
        'piggybank' => [
            'name' => 'Piggy bank',
            'route' => '/piggy-banks',
            'class' => 'FireflyIII\Http\Controllers\PiggyBankController'
        ],
        'rules' => [
            'name' => 'Rules',
            'route' => '/rules',
            'class' => [
                'FireflyIII\Http\Controllers\Rule\CreateController',
                'FireflyIII\Http\Controllers\Rule\DeleteController',
                'FireflyIII\Http\Controllers\Rule\EditController',
                'FireflyIII\Http\Controllers\Rule\IndexController',
                'FireflyIII\Http\Controllers\Rule\SelectController',
            ]
        ],
        'recurring' => [
            'name' => 'Recurring',
            'route' => '/recurring',
            'class' => [
                'FireflyIII\Http\Controllers\Recurring\CreateController',
                'FireflyIII\Http\Controllers\Recurring\DeleteController',
                'FireflyIII\Http\Controllers\Recurring\EditController',
                'FireflyIII\Http\Controllers\Recurring\IndexController',
                'FireflyIII\Http\Controllers\Recurring\ShowController',
            ]
        ]
    ];

    public static $classMap = null;

    public static $routeMap = null;

    public function __construct()
    {
        if (static::$classMap === null) {
            // We'll only get the classmap from the cache once per request, and it should be cached forever
            // when generated (cache should be cleared on code updates, so it's up-to-date anyway)
            static::$classMap = Cache::rememberForever(
                'featureAccess.map',
                \Closure::fromCallable([$this, 'mapFeatures'])
            ) ['classes'];
        }
        if (static::$routeMap === null) {
            static::$routeMap = Cache::rememberForever(
                'featureAccess.map',
                \Closure::fromCallable([$this, 'mapFeatures'])
            ) ['routes'];
        }
    }

    public function handle(Request $request, Closure $next)
    {
        /** @var UserRepositoryInterface $userRep */
        $userRep = app(UserRepositoryInterface::class);
        /** @var User $user */
        $user = auth()->user();

        $class = get_class($request->route()->controller);
        $method = $request->route()->getActionMethod();

        if (!empty(static::$classMap[$class.'@'.$method])) {
            $lvlIdx = static::$classMap[$class.'@'.$method];
        } else if (!empty(static::$classMap[$class])) {
            $lvlIdx = static::$classMap[$class];
        } else if ($route = static::routeInMap($request->getPathInfo())) {
            $lvlIdx = static::$routeMap[$route];
        } else {
            // If not defined, assume no limiting
            return $next($request);
        }

        $product = SubProducts::getSubProductIndex($lvlIdx);
        if (empty($product)) {
            // Product with index doesn't exist, skip check
            return $next($request);
        }

        if (!$userRep->hasFeature($user, $product)) {
            session()->flash('error', trans('features.no_access', ['name' => $product->name]));
            return redirect(session()->previousUrl());
        }

        return $next($request);
    }

    public static function routeInMap($path)
    {
        foreach (static::$routeMap as $route => $_) {
            if (strpos($route, $path) === 0) {
                return $route;
            }
        }
        return false;
    }

    public static function mapFeatures(): array
    {
        $map = [
            'classes' => [],
            'routes' => []
        ];

        foreach (static::$levels as $lvlIdx => $level) {
//            $lvlName = $level['name']; // Maybe use for something?
            foreach ($level['features'] as $featureNotation) {
                $feature = static::getFeature($featureNotation);
                if (empty($feature)) {
                    continue; // Feature couldn't be found by the specified notation, skip
                }

                foreach ($map as $type => $_) {

                    $t = Str::singular($type);
                    $values = $feature[$t];
                    if (!is_array($values)) $values = [$values];

                    foreach ($values as $value) {
                        $map[$type][$value] = $lvlIdx;
                    }
                }

            }
        }

        return $map;
    }

    public static function getFeature($feature): ?array
    {
        if (!empty(static::features[$feature])) {
            return static::features[$feature];
        }

        // If featureNotation is set as `feature.method`, we need a more advanced check
        if (strpos($feature, '.') !== false) {
            $order = explode('.', $feature);
            $feature = reset($order);

            $obj = static::getFeature($feature);
            if ($obj !== null) {
                $classes = $obj['class'];
                $method = next($order);
                if (is_array($classes)) {
                    foreach ($classes as $class) {
                        if (stripos($class, $method) !== false) {
                            $copy = $obj;
                            $copy['class'] = $class;
                            $copy['route'] = $copy['route'] .'/'. $method;
                            return $copy;
                        }
                    }
                } else {
                    if (method_exists($classes, $method)) {
                        $copy = $obj;
                        $copy['class'] = $classes .'@'. $method;
                        $copy['route'] = $copy['route'] .'/'. $method;
                        return $copy;
                    }
                }
            }
        }

        // Featurenotation is specified as a route
        if (strpos($feature, '/') !== false) {
            $order = explode('/', $feature);
            $feature = reset($order);

            $obj = static::getFeature($feature);
            if ($obj !== null) {
                $route = $obj['route'];
                $blockRoute = $route;
                while (false !== ($method = next($order))) {
                    $blockRoute .= '/'.$method;
                }

                return [
                    'class' => [],
                    'route' => $blockRoute
                ];

            }
        }

        return null;
    }

    public static function getFeatureNames($level = 0)
    {
        $names = [];
        foreach (static::$levels[$level]['features'] as $feature) {
            $name = static::getFeatureName($feature);
            if (!empty($name)) {
                $names[] = $name;
            }
        }
        return array_unique($names);
    }

    public static function getFeatureName($route)
    {
        // Get the index of the route, we just want simple names for our list
        if (strpos($route, '.') !== false) {
            $route = preg_replace('/([a-zA-Z0-9]+\.)+[a-zA-Z0-9]+/', '$1index', $route);
        } else {
            $route .= '.index';
        }
        /** @var BreadcrumbsManager $manager */
        $manager = app(BreadcrumbsManager::class);
        if ($manager->exists($route)) {
            try {
                $item = $manager->generate($route)->last();
                return $item->title;
            } catch (\Exception $ex) {
                return '';
            }
        } else {
            return '';
        }
    }

    public function userHasAccessToPath($path)
    {
        /** @var UserRepositoryInterface $userRep */
        $userRep = app(UserRepositoryInterface::class);
        /** @var User $user */
        $user = auth()->user();

        if ($route = static::routeInMap($path)) {
            $lvlIdx = static::$routeMap[$route];
            $product = SubProducts::getSubProductIndex($lvlIdx);
            if (empty($product)) {
                return true;
            }
            return $userRep->hasFeature($user, $product);
        }
        return true;
    }
}