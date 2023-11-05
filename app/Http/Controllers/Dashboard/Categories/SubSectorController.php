<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Enum\EnumGeneral;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Categories\SectionRequest;
use App\Http\Requests\Dashboard\Categories\SubSectorRequest;
use App\Repository\Dashboard\Categories\SectorRepository;
use App\Repository\Dashboard\Categories\SubSectorRepository;
use DataTables;

class SubSectorController extends Controller
{
    private $section;
    private $sector;


    public function __construct(SubSectorRepository $section, SectorRepository $sector)
    {
        $this->section = $section;
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
            $data = $this->section->all();
            return $this->sectionsDataTable($data)->escapeColumns([])->make(true);
        }
        return view('category.section.index');
    }
    // !tabel
    private function sectionsDataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('name', function ($data) {
                return "<a href='" . route('category.sub_sector.edit', $data->id) . "'>" . $data->getName() . "</a>";
            })->addColumn('sector', function ($data) {
                if (app()->getLocale() == 'en') {
                    return $data->sector->name_en;
                } else {
                    return $data->sector->name_ar;
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
                if (true/*count($data->commercialActivities) || count($data->getOffers)*/) {
                    $delete = '';
                } else {
                    $delete = '
                    <a class="btn btn-danger btn-sm rounded text-light" id="del" data-url="' . route('category.activity.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                    ';
                }
                $button = '
                <a class="btn btn-info btn-sm rounded" href="' . route('category.sub_sector.edit', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
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
        $sectors = $this->sector->getByStatus(EnumGeneral::ACTIVE);
        return view('category.section.action.create', compact('sectors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubSectorRequest $request)
    {
        $this->section->create($request->validated());
        return to_route('category.sub_sector.index');
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
        $sectors = $this->sector->getByStatus(EnumGeneral::ACTIVE);
        $section = $this->section->getById($id);
        return view('category.section.action.edit', compact('sectors', 'section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubSectorRequest $request, string $id)
    {
        $this->section->update($id, $request->validated());
        return to_route('category.sub_sector.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->section->getById($id)->delete();
    }
}
