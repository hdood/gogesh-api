<?php

namespace App\Table\Ads;

use App\Enum\EnumGeneral;
use App\Repository\Dashboard\Ads\AdsRepository;
use DataTables;
use Illuminate\Http\Request;

class AdsTable
{

    public function __construct(private Request $request, private AdsRepository $repository)
    {
    }
    public function render()
    {
        if ($this->request->ajax()) {
            $data = $this->repository->all();
            return $this->DataTable($data)->escapeColumns([])->make(true);
        }
        return view('ads.index');
    }
    // !tabel
    private function DataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('title', function ($data) {
                return "<a href='" . route('ads.edit', $data->id) . "'>$data->title</a>";
            })
            ->addColumn('price', function ($data) {
                return $data->price;
            })

            ->addColumn('date_start', function ($data) {
                return $data->date_start;
            })
            ->addColumn('date_end', function ($data) {
                return $data->date_end;
            })
            ->addColumn('status', function ($data) {
                if ($data->status == 'Approved') {
                    $stat = '<span id="spanStatus_' . $data->id . '"><span class="badge rounded-pill bg-success text-light">' . __($data->status) . '</span></span>';
                } elseif ($data->status == 'Rejected') {
                    $stat = '<span id="spanStatus"><span class="badge rounded-pill bg-danger text-light">' . __($data->status) . '</span></span>';
                } elseif ($data->status == 'Pending') {
                    $stat = '<span id="spanStatus_' . $data->id . '"><span class="badge rounded-pill bg-warning text-light">' . __($data->status) . '</span></span>';
                } elseif ($data->status == EnumGeneral::NOT_PAID) {
                    $stat = '<span id="spanStatus_' . $data->id . '"><span class="badge rounded-pill bg-info text-light">' . __($data->status) . '</span></span>';
                }
                return $stat;
            })
            ->addColumn('action', function ($data) {
                if ($data->status == EnumGeneral::PENDING) {
                    $approved = '<a class="btn btn-success btn-sm rounded text-light" id="approved"  data-url="' . route('ajax.approved', $data->id) . '?type=ads" data-id="' . $data->id . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-check"></i></a>';
                } else {
                    $approved = '';
                }
                $button = '
              <a class="btn btn-info btn-sm rounded" href="' . route('ads.edit', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
              <a class="btn btn-danger btn-sm rounded text-light" id="del" data-url="' . route('ads.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                ' . $approved . '

            ';
                return $button;
            });
    }
}
