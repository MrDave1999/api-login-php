<?php 
namespace App\Http\Repositories;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IBaseRepository
{
    public function __construct(private Model $model)
    {
        
    }

    function isExists(string $attribute, $value)
    {
        return !is_null($this->model->where($attribute, $value)->first());
    }
}