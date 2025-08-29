<?php

namespace Database\Factories\Traits;

use App\Models\Article;
use App\Models\Product;
use Fomvasss\MediaLibraryExtension\HasMedia\HasMedia;
use Illuminate\Database\Eloquent\Model;

trait HasFakeImageToModelTrait
{
    public function hasFakeImageToModelTrait(HasMedia $model, int $count = 1): bool
    {
        try {

            if ($model instanceof Product) {
                if(rand(1,100000000) === 5) {
                    $model
                        ->addMediaFromUrl('https://picsum.photos/600/400')
                        ->toMediaCollection('images');
                }
            }

//                for ($i = 0; $i < $count; $i++) {
//                    $model->addMediaFromUrl('https://picsum.photos/600/400')
//                        ->toMediaCollection('images');
//                }






               return 1;
        }catch (\Exception $exception){
                return 0;
        }
    }
}
