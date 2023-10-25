<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\TransactionsExport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportController extends Controller
{
    /**
     * Generate and download the report based on a date range.
     *
     * @param Request $request
     * @return BinaryFileResponse
     */
    public function downloadReport(Request $request): BinaryFileResponse
    {
        // Get the start and end dates from the request.
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Filter transactions based on the date range.
        $transactions = Transaction::whereBetween('date', [$startDate, $endDate])->get();

        // Download the report.
        return Excel::download(new TransactionsExport($transactions), 'transactions_report.xlsx');
    }
}
