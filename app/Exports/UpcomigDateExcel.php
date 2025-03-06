<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Illuminate\Support\Facades\Schema;

class UpcomigDateExcel implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $query;
    protected $columns;

    public function __construct($query)
    {
        $this->query = $query;
        $this->columns = Schema::getColumnListing('trademark_users'); // Store column names
    }

    public function collection()
    {
        return $this->query;
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
        
        // Generate column letters dynamically (A, B, ..., Z, AA, AB, AC...)
        $columns = [];
        for ($i = 0; $i < count($this->columns); $i++) {
            $columns[] = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($i + 1);
        }
    
        foreach ($this->columns as $index => $heading) {
            $columnWidths[$columns[$index]] = max(strlen($heading), 10) + 5;
        }
    
        return $columnWidths;
    }
    

    public function map($row): array
    {
        $columnsData = [];
    
        // Fill associative array with correct values
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
