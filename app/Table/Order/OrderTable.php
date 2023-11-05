<?php

namespace App\Table\Order;

use DataTables;
use App\Models\Order;
use App\Enum\EnumGeneral;
use Illuminate\Http\Request;
use App\Repository\Dashboard\Ads\AdsRepository;

class OrderTable
{

    public function __construct(private Request $request, private AdsRepository $repository)
    {
    }
    public function render()
    {
        if ($this->request->ajax()) {
            $data = Order::get();
            return $this->DataTable($data)->escapeColumns([])->make(true);
        }
        return view('orderOffer.index');
    }
    // !tabel
    private function DataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('offer_id', function ($data) {
                return $data->offer_id;
            })->addColumn('offer_title', function ($data) {
                return $data->offer->title;
            })->addColumn('customer_name', function ($data) {
                return $data->customer->firstname . ' ' . $data->customer->lastname;
            })
            ->addColumn('created_at', function ($data) {
                if ($data->created_at) {
                    return $data->created_at->format('Y-m-d H:i:s');
                }
                return '';
            })
            ->addColumn('action', function ($data) {
                $button = '
              <a class="btn btn-danger btn-sm rounded text-light" id="del" data-url="' . route('order.offer.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
            ';
                return $button;
            });
    }
}
