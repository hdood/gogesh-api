<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Enum\EnumGeneral;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Categories\SeasonRequest;
use App\Repository\Dashboard\Categories\SeasonRepository;
use DataTables;

class SeasonController extends Controller
{
    private $season;


    public function __construct(SeasonRepository $season)
    {
        $this->season = $season;

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
            $data = $this->season->all();
            return $this->seasonsDataTable($data)->escapeColumns([])->make(true);
        }
        return view('category.season.index');
    }
    // !tabel
    private function seasonsDataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('name', function ($data) {
                if (app()->getLocale() == 'en') {
                    return "<a href='" . route('category.season.edit', $data->id) . "'>$data->name_en</a>";
                } else {
                    return "<a href='" . route('category.season.edit', $data->id) . "'>$data->name_ar</a>";
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
                if (count($data->offers)) {
                    $delete = '';
                } else {
                    $delete = '
                    <a class="btn btn-danger btn-sm rounded text-light" id="del" data-url="' . route('category.season.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                    ';
                }
                $button = '
                <a class="btn btn-info btn-sm rounded" href="' . route('category.season.edit', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
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
        return view('category.season.action.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SeasonRequest $request)
    {
        $this->season->create($request->validated());
        return to_route('category.season.index');
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
        $season = $this->season->getById($id);
        return view('category.season.action.edit', compact('season'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SeasonRequest $request, string $id)
    {
        $this->season->update($id, $request->validated());
        return to_route('category.season.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->season->getById($id)->delete();
    }
}
