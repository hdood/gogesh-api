<?php

namespace App\Table\Customer;

use App\Enum\EnumGeneral;
use App\Repository\Dashboard\Ads\AdsRepository;
use App\Repository\Dashboard\CustomerRepository;
use DataTables;
use Illuminate\Http\Request;

class CustomerTable
{

    public function __construct(private Request $request, private CustomerRepository $repository)
    {
    }
    public function render()
    {
        if ($this->request->ajax()) {
            $data = $this->repository->all();
            return $this->DataTable($data)->escapeColumns([])->make(true);
        }
        return view('customer.index');
    }
    // !tabel
    private function DataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('DT_RowId', function ($data) {
                return route('order.customer.index') . '?id=' . $data->id;
            })
            ->addColumn('image', function ($data) {
                if (!empty($data->image)) {
                    $image = $data->image;
                } else {
                    $image = 'static/img/admin.jpg';
                };
                return "<img class='rounded-circle' id='image-circle' src='" . asset($image) . "' alt='customer'>";
            })
            ->addColumn('name', function ($data) {
                return "<a href='" . route('customer.edit', $data->id) . "'>" . $data->firstname . ' ' . $data->lastname . "</a>";
            })
            ->addColumn('email', function ($data) {
                return $data->email;
            })
            ->addColumn('created_at', function ($data) {
                if ($data->created_at) {
                    return $data->created_at->format('d/m/Y');
                }
                return '';
            })
            ->addColumn('status', function ($data) {
                if ($data->status == EnumGeneral::ACTIVE) {
                    $stat = '<span class="badge rounded-pill bg-success text-light">' . __($data->status) . '</span>';
                } elseif ($data->status == EnumGeneral::INACTIVE) {
                    $stat = '<span class="badge rounded-pill bg-danger text-light">' . __($data->status) . '</span>';
                }
                return $stat;
            })
            ->addColumn('action', function ($data) {
                if ($data->status == EnumGeneral::PENDING) {
                    $approved = '<a class="btn btn-success btn-sm rounded text-light"  data-url="' . route('customer.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-check"></i></a>';
                } else {
                    $approved = '';
                }
                $button = '
              <a class="btn btn-info btn-sm rounded" href="' . route('customer.edit', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
              <a class="btn btn-danger btn-sm rounded text-light" id="del" data-url="' . route('customer.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                ' . $approved . '

            ';
                return $button;
            });
    }
}
