<?php

namespace App\Http\Admin\Controllers;

use App\Http\Admin\Requests\TermRequest;
use App\Http\Controllers\Controller;
use App\Models\Term;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class TermController extends Controller
{
    public function index(string $vocabularySlug): View
    {
        $this->authorize('viewAny', Term::class);

        $key = Term::vocabulariesList('key', 'slug')[$vocabularySlug];

        $terms = Term::whereVocabulary($key)->get();

        return view('admin.terms.index', [
            'terms' => $terms,
            'vocabulary' => $this->getVocabulary($key),
        ]);
    }

    public function create(string $vocabularySlug): View
    {
        $this->authorize('create', Term::class);

        $key = Term::vocabulariesList('key', 'slug')[$vocabularySlug];

        return view('admin.terms.create', ['vocabulary' => $this->getVocabulary($key)]);
    }

    public function store(TermRequest $request, string $vocabularySlug): RedirectResponse
    {
        $this->authorize('create', Term::class);

        $key = Term::vocabulariesList('key', 'slug')[$vocabularySlug];

        $term = Term::query()->create(array_merge($request->getData(), ['vocabulary' => $key]));

        $term->seo()->updateOrCreate([], ['tags' => $request->getSeo()]);

        $term->mediaManage($request);

        return redirect()->route('admin.terms.edit', $term);
    }

    public function edit(Term $term): View
    {
        $this->authorize('update', $term);

        $vocabulary = $this->getVocabulary($term->vocabulary);

        return view('admin.terms.edit', compact('term','vocabulary'));
    }

    public function update(TermRequest $request, Term $term): RedirectResponse
    {
        $this->authorize('update', $term);

        $term->update($request->getData());

        $term->seo()->updateOrCreate([], ['tags' => $request->getSeo()]);

        $term->mediaManage($request);

        return redirect()->route('admin.terms.edit', $term);
    }

    public function destroy(Term $term): RedirectResponse
    {
        $this->authorize('delete', $term);

        $term->delete();

        return redirect()->back();
    }

    public function order(Request $request): Response
    {
        $this->validate($request, [
            'data' => 'required|array'
        ]);

        $entities = build_linear_array_sort($request->data);

        foreach ($entities as $entity) {
            $term = Term::query()->where('id', $entity['id'])->first();

            $term->update([
                'parent_id' => $entity['parent_id'],
                'weight' => $entity['weight'],
            ]);
        }

        return response()
            ->json(['message' => trans('lte::alerts.update.success')], Response::HTTP_ACCEPTED);
    }

    public function getVocabulary(string $key): array
    {
        $vocabularies = Term::vocabulariesList();

        return array_values(array_filter($vocabularies, fn($v) => $v['key'] === $key))[0];
    }
}
