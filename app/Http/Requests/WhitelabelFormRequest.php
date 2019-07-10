<?php

declare(strict_types=1);

namespace FireflyIII\Http\Requests;


class WhitelabelFormRequest extends Request
{

    public function authorize(): bool
    {
        // Only allow logged and admins
        return auth()->check();
    }

    public function rules(): array
    {
        $nameRule = 'required|min:1|unique:whitelabels,name';
        $domainRule = 'required|min:5|unique:whitelabels,domain';
        $activeRule = '';
        $idRule = '';

        if (null !== $this->route()->parameter('whitelabel')) {
            $idRule = 'exists:whitelabels,id';
            $nameRule = 'required|min:1';
            $domainRule = 'required|min:5';
        }

        $rules = [
            'id' => $idRule,
            'name' => $nameRule,
            'domain' => $domainRule,
            'active' => $activeRule
        ];

        return $rules;
    }
}