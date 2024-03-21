<?php

namespace App\Exports;

use App\Models\Reception;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

class ReceptionsExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(public $start_date, public $end_date, public $client_id, public $search)
    {
    }

    public function query()
    {
        $query = Reception::query();
        if($this->start_date && $this->end_date){
            $query->whereBetween('created_at', [$this->start_date, $this->end_date]);
        }
        if($this->client_id){
            $query->where('client_id', $this->client_id);
        }
        if($this->search){
            $query->whereAny([
                'custom_id',
                'equipment_type',
                'brand',
                'model',
                'serie',
                'capability',
            ], 'LIKE', '%'.$this->search.'%');
        }
        return $query;
    }
}
