<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsExport implements FromCollection, WithHeadings
{
    protected $transactions;

    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    /**
     * Define the columns for the export.
     *
     * @return Collection
     */
    public function collection()
    {
        return collect($this->transactions)->map(function ($transaction) {
            return [
                $transaction->card_number,
                $transaction->date,
                $transaction->time,
                $transaction->program_list,
                $transaction->duration,
                $transaction->cost
            ];
        });
    }

    /**
     * Define the headers for each column.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Card Number',
            'Date',
            'Time',
            'List of Programs',
            'Duration',
            'Cost'
        ];
    }
}
