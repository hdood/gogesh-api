<?php

namespace App\Http\Controllers\Dashboard\Categories;

use App\Enum\EnumGeneral;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Categories\ActivityRequest;
use App\Repository\Dashboard\Categories\ActivityRepository;
use App\Repository\Dashboard\Categories\SectorRepository;
use App\Repository\Dashboard\Categories\SubSectorRepository;
use DataTables;

class ActivityController extends Controller
{
    public function __construct(
        private ActivityRepository $activity,
        private SectorRepository $sector,
        private SubSectorRepository $subSector
    ) {
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
            $data = $this->activity->all();
            return $this->activitiesDataTable($data)->escapeColumns([])->make(true);
        }
        return view('category.activity.index');
    }
    // !tabel
    private function activitiesDataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('name', function ($data) {
                if (app()->getLocale() == 'en') {
                    return "<a href='" . route('category.activity.edit', $data->id) . "'>$data->name_en</a>";
                } else {
                    return "<a href='" . route('category.activity.edit', $data->id) . "'>$data->name_ar</a>";
                }
            })
            ->addColumn('code', function ($data) {
                return $data->code;
            })
            ->addColumn('subSector', function ($data) {
                return $data->subSector->getName();
            })
            ->addColumn('sector', function ($data) {
                return $data->subSector->sector->getName();
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
                    <a class="btn btn-danger btn-sm rounded text-light" id="del" data-url="' . route('category.activity.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                    ';
                }
                $button = '
                <a class="btn btn-info btn-sm rounded" href="' . route('category.activity.edit', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
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
        $sectors = $this->sector->all();
        $subSectors = $this->subSector->all();
        return view('category.activity.action.create', compact('sectors', 'subSectors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityRequest $request)
    {
        $this->activity->create($request->validated());
        return to_route('category.activity.index');
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
        $sectors = $this->sector->all();
        $subSectors = $this->subSector->all();
        $activity = $this->activity->getById($id);
        return view('category.activity.action.edit', compact('sectors', 'subSectors', 'activity'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActivityRequest $request, string $id)
    {
        $this->activity->update($id, $request->validated());
        return to_route('category.activity.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->activity->getById($id)->delete();
    }
}
