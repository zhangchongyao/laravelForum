<?php


namespace App\Models\Traits;


Trait QueryBuilderBindable
{
    public function resolveRouteBinding($value)
    {
        $queryClass = property_exists($this, 'queryClass')
            ? $this->queryClass
            : '\\APP\\Http\\Queries\\' . class_basename(self::class). 'Quert';

        if(!class_exists($queryClass)) {
            return parent::resolveRouteBinding($value);
        }

        return (new $queryClass($this))
            ->where($this->getRouteKeyName(), $value)
            ->first();
    }
}
