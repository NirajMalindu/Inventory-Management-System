<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use PDF; // from Barryvdh DomPDF



class StockReportController extends Controller
{
    public function index(){

        $product = Product::with('stockLedgers')->get();

        //calculate totals for each product
        $report = $product->map(function ($product){
            $totalIn = $product->stockLedgers()->where('type', 'in')->sum('in');
            $totalOut = $product->stockLedgers()->where('type', 'out')->sum('out');
            $currentStock = $totalIn-$totalOut;

            return[
                'name' =>$product->name,
                'category' =>$product->category->name,
                'total_in' => $totalIn,
                'total_out'=> $totalOut,
                'current_stock' => $currentStock,
            ];
        });

        return view('reports.stock', compact('report'));
    }

    //download report pdf
    public function exportPdf()
    {
        $report = Product::with('stockLedgers')->get()->map(function ($product) {
            $in = $product->stockLedgers->sum('in');
            $out = $product->stockLedgers->sum('out');
            return [
                'name' => $product->name,
                'category' => $product->category->name ?? 'N/A',
                'total_in' => $in,
                'total_out' => $out,
                'current_stock' => $in - $out,
            ];
        });

        $pdf = Pdf::loadView('reports.stock_pdf', compact('report'));

        return $pdf->download('Stock_Report.pdf');
    }
}
