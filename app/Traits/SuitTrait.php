<?php
namespace App\Traits;

trait SuitTrait
{
    public function getAll($model)
    {
        return response()->json($model::all());
    }

    // You can add more methods here
}