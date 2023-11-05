<?php

namespace App\Table\Offer;

use DataTables;
use App\Enum\EnumGeneral;
use Illuminate\Http\Request;
use App\Repository\Dashboard\Offer\DurationRepository;

class DurationTable
{

    public function __construct(private Request $request, private DurationRepository $repository)
    {
    }
    public function render()
    {
        if ($this->request->ajax()) {
            $data = $this->repository->all();
            return $this->DataTable($data)->escapeColumns([])->make(true);
        }
        return view('duration.index');
    }
    // !tabel
    private function DataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('name', function ($data) {
                return "<a href='" . route('offer.duration.edit', $data->id) . "'>" . $data->duration . ' ' . __($data->type) . "</a>";
            })
            ->addColumn('created_at', function ($data) {
                if ($data->created_at) {
                    return $data->created_at->format('d/m/Y');
                }
                return '';
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

                if (!count($data->offers)) {
                    $delete = '<a class="btn btn-danger btn-sm rounded text-light" id="del" data-url="' .route('offer.duration.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>';
                } else {
                    $delete = '';
                }
                $button = '
          <a class="btn btn-info btn-sm rounded" href="' . route('offer.duration.edit', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
            ' . $delete . '
        ';
                return $button;
            });
    }
}
