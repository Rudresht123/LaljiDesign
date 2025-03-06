<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Illuminate\Support\Facades\Schema;

class DPPExportExcels implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $query;
    protected $request;
    protected $columns;

    public function __construct($query, $request)
    {
        $this->query = $query;
        $this->request = $request;
        
        // Fetch all column names from the model's table dynamically
        $this->columns = Schema::getColumnListing('trademark_users');
    }

    public function collection()
    {
        $requestdata = $this->request->all();

        return $this->query
        ->whereIn('id',$requestdata['clients_id'])
            ->whereIn('category_id', $requestdata['category_id'] ?? [])
            ->whereIn('financial_year', $requestdata['financial_year'] ?? [])
            ->get();
    }

    public function headings(): array
    {
        return $this->columns;
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4CAF50']],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }

    public function columnWidths(): array
    {
        $columnWidths = [];
        $columns = range('A', 'Z'); // Extend if needed

     
        foreach ($this->columns as $index => $column) {
            $columnWidths[$columns[$index] ?? 'Z'] = 20; // Default width
        }
        return $columnWidths;
    }

   
    public function map($row): array
    {
        $columnsData = [];
        foreach ($this->columns as $column) {
            switch ($column) {
                case 'office_id':
                    $columnsData[$column] = $row->office->office_name ?? '';
                    break;
                case 'category_id':
                    $columnsData[$column] = $row->mainCategory->category_name ?? '';
                    break;
                case 'attorney_id':
                    $columnsData[$column] = $row->attorney->attorneys_name ?? '';
                    break;
                case 'status':
                    $columnsData[$column] = $row->statusMain->status_name ?? '';
                    break;
                case 'sub_status':
                    $columnsData[$column] = $row->subStatus->substatus_name ?? '';
                    break;
                case 'deal_with':
                    $columnsData[$column] = $row->dealWith->dealler_name ?? '';
                    break;
                case 'financial_year':
                    $columnsData[$column] = $row->financialYear->financial_session ?? '';
                    break;
                case 'consultant':
                    $columnsData[$column] = $row->Clientonsultant->consultant_name ?? '';
                    break;
                case 'client_remarks':
                    $columnsData[$column] = $row->clientRemark->client_remarks ?? '';
                    break;
                case 'remarks':
                    $columnsData[$column] = $row->remarksMain->remarks_name ?? '';
                    break;
                default:
                    $columnsData[$column] = $row->$column ?? '';
            }
        }
    
        // Ensure the output maintains the correct order
        return array_map(fn($col) => $columnsData[$col] ?? 'NA', $this->columns);
    }
}
