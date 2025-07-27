<?php

declare(strict_types=1);

namespace App\Services;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GetReference
{
    public static function reference(string $reference): ?string
    {
        return match ($reference) {
            User::class  => 'User',
            default      => class_basename($reference),
        };
    }

    public static function getModel(string $reference): ?string
    {
        $reference = Str::studly($reference);
        $model     = 'App\\Models\\' . $reference;

        return match ($reference) {
            'User'  => User::class,
            default => class_exists($model) ? $model : null,
        };
    }

    public static function findOrFail(string $className, string $id, string $key='id'): ?Model
    {
        /** @var string $model “App\\Models\\ProductInterface” */
        $model = self::getModel($className);
        if ($model === null) {
            abort(404);
        }


        $model = resolve($model);
        $model =  $model->where($key, $id)->first();
        if ($model === null) {
            abort(404);
        }

        return $model;
    }
}
