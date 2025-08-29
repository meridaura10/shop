<?php

namespace App\Http\Requests\Traits;

trait SeoRulesTrait
{
    public function seoRules(): array
    {
        return [
            'seo' => ['array'],
            'seo.title' => ['nullable', 'string', 'max:255'],
            'seo.description' => ['nullable', 'string', 'max:2048'],
            'seo.keywords' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function exceptSeoRules(): array
    {
       return array_keys($this->seoRules());
    }

    public function getSeo(): array
    {
        return $this->input('seo');
    }
}
