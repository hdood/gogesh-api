<?php

namespace App\Table\CommercialActivity;

use DataTables;
use App\Enum\EnumGeneral;
use Illuminate\Http\Request;
use App\Repository\Dashboard\Ads\AdsRepository;
use App\Repository\Dashboard\CommercialActivity\CommercialActivityRepository;

class CommercialActivityTable
{

    public function __construct(private Request $request, private CommercialActivityRepository $repository)
    {
    }
    public function render()
    {
        if ($this->request->ajax()) {
            $data = $this->repository->all();
            return $this->DataTable($data)->escapeColumns([])->make(true);
        }
        return view('commercialActivity.index');
    }
    // !tabel
    private function DataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('logo', function ($data) {
                if (!empty($data->logo)) {
                    $logo = asset($data->logo);
                } else {
                    $logo = 'static/img/admin.jpg';
                };
                return "<img class='rounded-circle' id='image-circle' src='" . $logo . "' alt='customer'>";
            })
            ->addColumn('name', function ($data) {
                return "<a href='" . route('commercialActivity.edit', $data->id) . "'>$data->name</a>";
            })
            
            ->addColumn('seller', function ($data) {
                return $data->seller->firstname . '' . $data->seller->lastname;
            })
            ->addColumn('created_at', function ($data) {
                if ($data->created_at) {
                    return $data->created_at->format('d/m/Y');
                }
                return '';
            })
            ->addColumn('status', function ($data) {
                if ($data->status == EnumGeneral::APPROVED) {
                    $stat = '<span class="badge rounded-pill bg-success text-light">' . __($data->status) . '</span>';
                } elseif ($data->status == EnumGeneral::REJECTED) {
                    $stat = '<span class="badge rounded-pill bg-danger text-light">' . __($data->status) . '</span>';
                } elseif ($data->status == EnumGeneral::PENDING) {
                    $stat = '<span class="badge rounded-pill bg-warning text-light">' . __($data->status) . '</span>';
                } elseif ($data->status == EnumGeneral::UPDATED) {
                    $stat = '<span class="badge rounded-pill bg-info text-light">' . __($data->status) . '</span>';
                }
                return $stat;
            })
            ->addColumn('action', function ($data) {

                $button = '
          <a class="btn btn-info btn-sm rounded" href="' . route('commercialActivity.edit', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
          <a class="btn btn-danger btn-sm rounded text-light" id="del" data-url="' . route('commercialActivity.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>

        ';
                return $button;
            });
    }
}
