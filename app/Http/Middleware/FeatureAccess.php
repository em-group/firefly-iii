<?php

declare(strict_types=1);

namespace FireflyIII\Http\Middleware;

use Closure;
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
            'bills',
            'budgets'
        ]
    ];

    const level_premium = [
        'features' => [
            // todo These are just examples for how we can define the feature list
            'categories.create',
            'bills.show'
        ]
    ];

    // todo Define all the features limited to a level
    const features = [
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
        } else if (false) {
            // todo Check route against routemap
            $lvlIdx = 0;
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
            session()->flash('error', 'You do not have access to '.$product->name.' level features, with your current plan');
            return redirect('/'); // todo Maybe just go back to the previous page?
        }

        return $next($request);
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

        return null;
    }
}