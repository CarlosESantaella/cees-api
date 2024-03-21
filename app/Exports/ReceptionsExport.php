<?php

namespace App\Exports;

use App\Models\Reception;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReceptionsExport implements FromQuery, ShouldAutoSize, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct(public $start_date, public $end_date, public $client_id, public $search, public $user_id)
    {
    }

    public function headings(): array
    {
        return [
            'Correlativo',
            'Cliente',
            'Tipo de equipo',
            'Marca',
            'Modelo',
            'Serie',
            'Capacidad',
            'Estado',
            'Comentarios',
            'Ubicación',
            'Ubicación específica',
            'Tipo de trabajo',
            'Persona que entrega',
            'Inventario del cliente',
            'Fecha de registro',
        ];
    }

    public function query()
    {
        $query = Reception::query();
        if ($this->start_date && $this->end_date) {
            $query->whereBetween('receptions.created_at', [$this->start_date, $this->end_date]);
        }
        if ($this->client_id) {
            $query->where('receptions.client_id', $this->client_id);
        }
        $query->where('user_id', $this->user_id);
        if ($this->search) {
            $query->whereAny([
                'receptions.custom_id',
                'receptions.equipment_type',
                'receptions.brand',
                'receptions.model',
                'receptions.serie',
                'receptions.capability',
            ], 'LIKE', '%' . $this->search . '%');
        }
        $query->join('clients', 'receptions.client_id', '=', 'clients.id');
        $query->select(
            'receptions.custom_id',
            'clients.full_name',
            'receptions.equipment_type',
            'receptions.brand',
            'receptions.model',
            'receptions.serie',
            'receptions.capability',
            'receptions.state',
            'receptions.comments',
            'receptions.location',
            'receptions.specific_location',
            'receptions.type_of_job',
            'receptions.equipment_owner',
            'receptions.customer_inventory',
            DB::raw("DATE_FORMAT(receptions.created_at, '%d-%m-%Y') as created_at_formatted")
            // 'receptions.created_at'
        );

        return $query;
    }
}
