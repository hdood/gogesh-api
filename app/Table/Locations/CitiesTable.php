<?php

namespace App\Table\Locations;

use DataTables;
use App\Enum\EnumGeneral;
use App\Repository\Dashboard\Locations\CitiesRepository;

use Illuminate\Http\Request;

class CitiesTable
{
    public function __construct(private Request $request, private CitiesRepository $repository)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function render()
    {
        if ($this->request->ajax()) {
            $data = $this->repository->all();
            return $this->DataTable($data)->escapeColumns([])->make(true);
        }
        return view('localition.cities.index');
    }
    // !tabel
    private function DataTable($data)
    {

        return Datatables::of($data)->addIndexColumn()
            ->addColumn('name', function ($data) {
                if (app()->getLocale() == 'en') {
                    return "<a href='" . route('location.cities.edit', $data->id) . "'>$data->name_en</a>";
                } else {
                    return "<a href='" . route('location.cities.edit', $data->id) . "'>$data->name_en</a>";
                }
            })
            ->addColumn('country', function ($data) {
                if (app()->getLocale() == 'en') {
                    return $data->country->name_en;
                } else {
                    return $data->country->name_ar;
                }
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
                if (count($data->sellers) || count($data->customers)) {
                    $delete = '';
                } else {
                    $delete = '
                        <a class="btn btn-danger btn-sm rounded text-light" id="del" data-url="' . route('location.cities.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                    ';
                }
                $button = '
                <a class="btn btn-info btn-sm rounded" href="' . route('location.cities.edit', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                ' . $delete . '
              ';
                return $button;
            });
    }
}
