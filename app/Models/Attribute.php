<?php

namespace App\Models;

use App\Models\Traits\Boot\HasSlug;
use Fomvasss\SimpleTaxonomy\Models\Traits\HasTaxonomies;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Attribute extends Model
{
    /** @use HasFactory<\Database\Factories\AttributeFactory> */
    use HasFactory, HasTaxonomies;

    protected $guarded = ['id'];

    public function characteristics(): HasMany
    {
        return $this->hasMany(Characteristic::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->terms()->whereVocabulary(Term::VOCABULARY_PRODUCT_CATEGORIES);
    }
}
