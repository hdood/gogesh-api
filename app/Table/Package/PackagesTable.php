<?php

namespace App\Table\Package;

use App\Enum\EnumGeneral;
use App\Repository\Dashboard\Package\PackageRepository;
use DataTables;
use Illuminate\Http\Request;

class PackagesTable
{
    public function __construct(private Request $request, private PackageRepository $repository)
    {
    }
    public function render()
    {
        if ($this->request->ajax()) {
            $data = $this->repository->all();
            return $this->DataTable($data)->escapeColumns([])->make(true);
        }
        return view('package.index');
    }
    // !tabel
    private function DataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('name', function ($data) {
                if (app()->getLocale() == 'en') {
                    return "<a href='" . route('package.edit', $data->id) . "'>$data->name_en</a>";
                } else {
                    return "<a href='" . route('package.edit', $data->id) . "'>$data->name_ar</a>";
                }
            })
            ->addColumn('price', function ($data) {
                return $data->price;
            })
            ->addColumn('credits', function ($data) {
                return $data->credits;
            })
            ->addColumn('duration', function ($data) {
                return $data->duration;
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
                    $approved = '<a class="btn btn-success btn-sm rounded text-light"  data-url="' . route('package.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-check"></i></a>';
                } else {
                    $approved = '';
                }
                $button = '
              <a class="btn btn-info btn-sm rounded" href="' . route('package.edit', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
              <a class="btn btn-danger btn-sm rounded text-light" id="del" data-url="' . route('package.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                ' . $approved . '

            ';
                return $button;
            });
    }
}
