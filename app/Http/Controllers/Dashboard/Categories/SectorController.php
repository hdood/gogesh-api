<?php

namespace App\Http\Controllers\Dashboard\Categories;

use DataTables;
use App\Enum\EnumGeneral;
use App\Models\Sector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Categories\SectorRequest;
use App\Repository\Dashboard\Categories\SectorRepository;

class SectorController extends Controller
{

    private $sector;


    public function __construct(SectorRepository $sector)
    {
        $this->sector = $sector;

        $this->middleware('permission:category-list|category-create|category-edit|category-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:category-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->sector->all();
            return $this->sectorsDataTable($data)->escapeColumns([])->make(true);
        }
        return view('category.sector.index');
    }
    // !tabel
    private function sectorsDataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('name', function ($data) {
                if (app()->getLocale() == 'en') {
                    return "<a href='" . route('category.sector.edit', $data->id) . "'>$data->name_en</a>";
                } else {
                    return "<a href='" . route('category.sector.edit', $data->id) . "'>$data->name_ar</a>";
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
                if (count($data->commercialActivities) || count($data->getOffers)) {
                    $delete = '';
                } else {
                    $delete = '
                    <a class="btn btn-danger btn-sm rounded text-light" id="del" data-url="' . route('category.sector.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                    ';
                }
                $button = '
                <a class="btn btn-info btn-sm rounded" href="' . route('category.sector.edit', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                ' . $delete . '
              ';
                return $button;
            });
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.sector.action.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SectorRequest $request)
    {
        $this->sector->create($request->validated());
        return to_route('category.sector.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sector = $this->sector->getById($id);
        return view('category.sector.action.edit', compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SectorRequest $request, string $id)
    {
        $this->sector->update($id, $request->validated());
        return to_route('category.sector.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->sector->getById($id)->delete();
    }
}
