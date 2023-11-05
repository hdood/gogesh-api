<?php

namespace App\Table\Services;

use App\Enum\EnumGeneral;
use App\Repository\Dashboard\Services\SectionRepository;
use App\Repository\Dashboard\Services\ServiceRepository;
use DataTables;
use Illuminate\Http\Request;

class SectionTable
{
    public function __construct(private Request $request, private SectionRepository $repository)
    {
    }
    public function render()
    {
        if ($this->request->ajax()) {
            $data = $this->repository->all();
            return $this->DataTable($data)->escapeColumns([])->make(true);
        }
        return view('services.section.index');
    }
    // !tabel
    private function DataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('name', function ($data) {
                return "<a href='" . route('services.section.edit', $data->id) . "'>" . $data->getName() . "</a>";
            })
            ->addColumn('service', function ($data) {
                return $data->service->getName();
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
                if (false) {
                    $delete = '';
                } else {
                    $delete = '
                    <a class="btn btn-danger btn-sm rounded text-light" id="del" data-url="' . route('services.service.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                    ';
                }
                $button = '
                <a class="btn btn-info btn-sm rounded" href="' . route('services.service.edit', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                ' . $delete . '

              ';

                return $button;
            });
    }
}
