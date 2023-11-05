<?php

namespace App\Table\Payment;

use DataTables;
use App\Enum\EnumGeneral;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionsTable
{
    public function __construct(private Request $request)
    {
    }
    public function render()
    {
        if ($this->request->ajax()) {
            $data = Transaction::all();
            return $this->DataTable($data)->escapeColumns([])->make(true);
        }
        return view('payments.transactions.index');
    }
    // !tabel
    private function DataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('seller_id', function ($data) {
                return $data->seller_id;
            })
            ->addColumn('seller_name', function ($data) {
                return $data->seller->firstname . ' ' . $data->seller->lastname;
            })
            ->addColumn('amount', function ($data) {
                return $data->amount;
            })
            ->addColumn('method_name', function ($data) {
                return $data->method_name;
            })
            ->addColumn('type', function ($data) {
                return $data->type;
            })
            ->addColumn('created_at', function ($data) {
                if ($data->created_at) {
                    return $data->created_at->format('d/m/Y');
                }
                return '';
            })
            ->addColumn('action', function ($data) {

                $button = '
          <a class="btn btn-danger btn-sm rounded text-light" id="del" data-url="' . route('payment.transaction.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>

        ';
                return $button;
            });
    }
}
