<?php

namespace App\Models\Traits\Boot;

use Illuminate\Database\Eloquent\Model;

trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::saving(function (Model $model) {
                $slug = $model->slug ? $model->slug : str()->slug(static::getTextToSlugGenerate($model)) ?? $model->id;
                $originalSlug = $slug;

                $i = 1;

                while (static::where('slug', $slug)
                    ->where('id', '!=', $model->id ?? 0)
                    ->exists()
                ) {
                    if($originalSlug){
                        $slug = $originalSlug . '-' . $i++;
                    }else{
                        $slug = uuid_create();
                    }
                }

                $model->slug = $slug;
        });
    }

    protected static function getTextToSlugGenerate(Model $model): null|string
    {
        if (property_exists($model, 'slugSource') && !empty($model->{$model->slugSource})) {
            return $model->{$model->slugSource};
        }

        return $model->name ? $model->name : uuid_create();
    }
}
