<?php

namespace App\Table\Offer;

use App\Repository\Dashboard\Offer\ReasonRepository;
use Illuminate\Http\Request;
use DataTables;

class ReasonTable
{


    public function __construct(private Request $request, private ReasonRepository $repository)
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
        return view('reason.index');
    }
    // !tabel
    private function DataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('title', function ($data) {
                return "<a href='" . route('offer.reason.edit', $data->id) . "'>" . $data->getTitle() . "</a>";
            })
            ->addColumn('created_at', function ($data) {
                if ($data->created_at) {
                    return $data->created_at->format('d/m/Y');
                }
                return '';
            })

            ->addColumn('action', function ($data) {
                if (!count($data->offers)) {
                    $delete = '<a class="btn btn-danger btn-sm rounded text-light" id="del" data-url="' . route('offer.reason.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>';
                } else {
                    $delete = '';
                }
                $button = '
                    <a class="btn btn-info btn-sm rounded" href="' . route('offer.reason.edit', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                        ' . $delete . '
                    ';
                return $button;
            });
    }
}
