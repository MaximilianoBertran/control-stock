<?php

namespace App\Traits;

trait Filters {

    /**
     * Scope a query to match users by upper(name).
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $column
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLikeUpper($query, $column, $value) {

        if ($value === null) {
            return $query;
        }
        $driver = $query->getConnection()->getDriverName();

        switch ($driver) {
            case 'pgsql':
                return $query->whereRaw("TRANSLATE(upper($column), 'áéíóúÁÉÍÓÚçÇ','aeiouAEIOUcC') ILIKE ?", ["%$value%"]);
                
//                return $query->where(DB::raw("TRANSLATE(upper(:column), 'áéíóúÁÉÍÓÚçÇ','aeiouAEIOUcC')", ['column' => $column]), 'ILIKE', '%' . $this->stripAccents($value) . '%');
            
            default:
                break;
        }

        return $query->where($this->stripAccents($column), 'LIKE', "%$value%");
    }

    protected function stripAccents($str) {
        return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }

}
