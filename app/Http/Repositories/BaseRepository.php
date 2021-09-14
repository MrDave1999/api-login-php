<?php 
namespace App\Http\Repositories;
use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    function isExists(string $attribute, $value)
    {
        return !is_null($this->model->where($attribute, $value)->first());
    }
}