<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function downloadReport(Request $request): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Filter transactions based on the date range
        $transactions = Transaction::whereBetween('date', [$startDate, $endDate])->get();

        // Download the report
        return Excel::download(new TransactionsExport($transactions), 'transactions_report.xlsx');
    }
}
