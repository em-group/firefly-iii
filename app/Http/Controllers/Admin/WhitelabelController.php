<?php

namespace FireflyIII\Http\Controllers\Admin;

use FireflyIII\Http\Controllers\Controller;
use FireflyIII\Http\Requests\WhitelabelFormRequest;
use FireflyIII\Models\Whitelabel;
use FireflyIII\Models\WhitelabelConfig;
use FireflyIII\Repositories\Whitelabel\WhitelabelRepositoryInterface;
use Illuminate\Http\Request;

class WhitelabelController extends Controller
{
    /** @var WhitelabelRepositoryInterface */
    private $repository;

    public function __construct()
    {
        parent::__construct();

        $this->middleware(
            function ($request, $next) {
                app('view')->share('title', (string)trans('firefly.administration'));
                app('view')->share('mainTitleIcon', 'fa-hand-spock-o');
                $this->repository = app(WhitelabelRepositoryInterface::class);
                return $next($request);
            }
        );
    }

    public function index()
    {
        $subTitle = (string)trans('whitelabels.manage');
        $subTitleIcon = 'fa-globe';
        $whitelabels = $this->repository->all();

        return view('admin.whitelabels.index', compact('subTitle', 'subTitleIcon', 'whitelabels'));
    }

    public function edit(Request $request, Whitelabel $whitelabel)
    {
        $subTitle = (string)trans('whitelabels.edit_whitelabel', ['name' => $whitelabel->name]);
        $subTitleIcon = 'fa-globe';

        $whitelabel->load('config');
        $configs = config('whitelabels.default_configs');
        foreach ($configs as $setting) {
            $missing = true;
            foreach ($whitelabel->config as $config) {
                if ($config->name == $setting) {
                    $missing = false;
                    break;
                }
            }
            if ($missing) {
                $whitelabel->config->add(new WhitelabelConfig([
                    'whitelabel_id' => $whitelabel->id,
                    'name' => $setting
                ]));
            }
        }

        // put previous url in session if not redirect from store (not "return_to_edit").
        if (true !== session('whitelabels.edit.fromUpdate')) {
            $this->rememberPreviousUri('whitelabels.edit.uri'); // @codeCoverageIgnore
        }
        $request->session()->forget('link-types.edit.fromUpdate');

        return view('admin.whitelabels.edit', compact('subTitle', 'subTitleIcon', 'whitelabel', 'configs'));
    }

    public function update(WhitelabelFormRequest $request, Whitelabel $whitelabel)
    {
        $data = [
            'name' => $request->string('name'),
            'domain' => $request->string('domain'),
            'active' => $request->boolean('active'),
            'config' => $request->input('config')
        ];
        $this->repository->update($whitelabel, $data);

        $request->session()->flash('success', (string)trans('whitelabels.updated', ['name' => $whitelabel->name]));

        $redirect = redirect($this->getPreviousUri('whitelabels.edit.uri'));
        if (1 === (int)$request->get('return_to_edit')) {
            $request->session()->put('whitelabels.edit.fromUpdate', true);

            $redirect = redirect(route('admin.whitelabels.edit', [$whitelabel->id]))->withInput(['return_to_edit' => 1]);
        }

        return $redirect;
    }

    public function create(Request $request)
    {
        $subTitle = (string)trans('whitelabels.create_whitelabel');
        $subTitleIcon = 'fa-globe';

        $configs = config('whitelabels.default_configs');

        if (true !== session('whitelabels.create.fromStore')) {
            $this->rememberPreviousUri('whitelabels.create.uri');
        }

        return view('admin.whitelabels.create', compact('subTitle', 'subTitleIcon', 'configs'));
    }

    public function store(WhitelabelFormRequest $request)
    {
        $data = [
            'name' => $request->string('name'),
            'domain' => $request->string('domain'),
            'active' => $request->boolean('active')
        ];
        $whitelabel = $this->repository->store($data);

        $request->session()->flash('success', (string)trans('whitelabels.created', ['name' => $whitelabel->name]));
        $redirect = redirect($this->getPreviousUri('whitelabels.create.uri'));
        if (1 === (int)$request->get('create_another')) {
            $request->session()->put('whitelabels.create.fromStore', true);

            $redirect = redirect(route('admin.whitelabels.create'))->withInput();
        }

        return $redirect;
    }

    public function deactivate(Whitelabel $whitelabel)
    {
        if ($this->repository->deactivate($whitelabel)) {
            session()->flash('success', (string)trans('whitelabels.deactivated', ['name' => $whitelabel->name]));
        } else {
            session()->flash('error', (string)trans('whitelabels.deactivate_error', ['name' => $whitelabel->name]));
        }

        return redirect(route('admin.whitelabels'));
    }

    public function activate(Whitelabel $whitelabel)
    {
        if ($this->repository->activate($whitelabel)) {
            session()->flash('success', (string)trans('whitelabels.activated', ['name' => $whitelabel->name]));
        } else {
            session()->flash('error', (string)trans('whitelabels.activate_error', ['name' => $whitelabel->name]));
        }

        return redirect(route('admin.whitelabels'));
    }
}
