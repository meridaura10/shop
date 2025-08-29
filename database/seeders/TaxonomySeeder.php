<?php

namespace Database\Seeders;

use App\Models\Term;
use Database\Factories\Traits\HasFakeImageToModelTrait;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class TaxonomySeeder extends Seeder
{
    use HasFakeImageToModelTrait;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seedVocabularies([
            // BRANDS & MODELS
            [
                'vocabulary' => Term::VOCABULARY_BRANDS,
                'terms' => [
                    [
                        'name' => 'Tesla',
                        'description' => 'Tesla Motors',
                    ],
                    [
                        'name' => 'BMW',
                        'description' => 'Bayerische Motoren Werke AG',
                    ],
                    [
                        'name' => 'Fendi',
                        'description' => 'Bayerische Motoren Werke AG',
                    ],
                    [
                        'name' => 'Saint Laurent',
                        'description' => 'Bayerische Motoren Werke AG',
                    ],
                    [
                        'name' => 'Giorgio Armani',
                        'description' => 'Bayerische Motoren Werke AG',
                    ],
                    [
                        'name' => 'Coach',
                        'description' => 'Bayerische Motoren Werke AG',
                    ],
                    [
                        'name' => 'Prada',
                        'description' => 'Bayerische Motoren Werke AG',
                    ],
                    [
                        'name' => 'Gucci',
                        'description' => 'Bayerische Motoren Werke AG',
                    ],
                    [
                        'name' => 'Loewe',
                        'description' => 'Bayerische Motoren Werke AG',
                    ],
                    [
                        'name' => 'Michael Kors',
                        'description' => 'Bayerische Motoren Werke AG',
                    ],
                ],
            ],

            [
                'vocabulary' => Term::VOCABULARY_PRODUCT_CATEGORIES,
                'terms' => [
                    [
                        'name' => 'Electronics',
                        'terms' => ['Alarms', 'DVRs', 'Audio'],
                    ],
                    [
                        'name' => 'Autochemistry',
                        'terms' => ['Washer', 'Shampoos', 'Polishes'],
                    ],
                    [
                        'name' => 'Wheels and rims',
                    ],
                ],
            ],


            [
                'vocabulary' => Term::VOCABULARY_ARTICLE_CATEGORIES,
                'terms' => [
                    [
                        'name' => 'Electronics',
                        'terms' => ['Alarms', 'DVRs', 'Audio'],
                    ],
                    [
                        'name' => 'Autochemistry',
                        'terms' => ['Washer', 'Shampoos', 'Polishes'],
                    ],
                    [
                        'name' => 'Wheels and rims',
                    ],
                ],
            ],
        ]);
    }

    /**
     * @param array $vocabularies
     */
    protected function seedVocabularies(array $vocabularies)
    {
        foreach ($vocabularies as $item) {
            if (! empty($item['terms'])) {
                $this->seedTerms($item['terms'], $item['vocabulary']);
            }
        }
    }

    /**
     * @param array $terms
     * @param string $vocabulary
     * @param null $parentId
     */
    protected function seedTerms(array $terms, string $vocabulary, $parentId = null)
    {
        $termModelClass = config('taxonomy.term_model');

        foreach ($terms as $item) {
            if (is_array($item)) {
                $term = $termModelClass::updateOrCreate([
                    'name' => $item['name'],
                    'vocabulary' => Arr::get($item, 'vocabulary', $vocabulary),
                    'status' => Term::STATUS_PUBLISHED,
                ], [
                    'slug' => isset($item['slug'])
                        ? Str::slug($item['slug'], '-')
                        : Str::slug($item['name'], '-'),
                  //  'description' => Arr::get($item, 'description'),
                    'parent_id' => $parentId,
                ]);
            } else {
                $term = $termModelClass::updateOrCreate([
                    'name' => $item,
                    'vocabulary' => $vocabulary,
                    'status' => Term::STATUS_PUBLISHED,
                ], [
                    'slug' => Str::slug($item),
                    'parent_id' => $parentId,
                ]);
            }

           $this->hasFakeImageToModelTrait($term, 1);

            $this->command->info(" - Term saved: {$term->id}: $term->name [{$term->vocabulary}]");

            if (! empty($item['terms'])) {
                $this->seedTerms($item['terms'], $vocabulary, $term->id);
            }
        }
    }
}
