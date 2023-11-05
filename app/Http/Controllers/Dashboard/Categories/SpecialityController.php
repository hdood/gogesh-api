<?php

namespace App\Http\Controllers\Dashboard\Categories;

use DataTables;
use App\Enum\EnumGeneral;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Categories\SpecialityRequest;
use App\Repository\Dashboard\Categories\SectorRepository;
use App\Repository\Dashboard\Categories\SpecialityRepository;

class SpecialityController extends Controller
{
    private $speciality;
    private $sector;


    public function __construct(SpecialityRepository $speciality, SectorRepository $sector)
    {
        $this->speciality = $speciality;
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
            $data = $this->speciality->all();
            return $this->specialitiesDataTable($data)->escapeColumns([])->make(true);
        }
        return view('category.speciality.index');
    }
    // !tabel
    private function specialitiesDataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('name', function ($data) {
                return "<a href='" . route('category.speciality.edit', $data->id) . "'>" . $data->getName() . "</a>";
            })
            ->addColumn('sector', function ($data) {
                return $data->activity->subSector->sector->getName();
            })
            ->addColumn('subSector', function ($data) {
                return $data->activity->subSector->getName();
            })
            ->addColumn('activity', function ($data) {
                return $data->activity->getName();
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
                    <a class="btn btn-danger btn-sm rounded text-light" id="del" data-url="' . route('category.speciality.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                    ';
                }
                $button = '
                <a class="btn btn-info btn-sm rounded" href="' . route('category.speciality.edit', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
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
        return view('category.speciality.action.create', compact('sectors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SpecialityRequest $request)
    {
        $this->speciality->create($request->validated());
        return to_route('category.speciality.index');
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
        $speciality = $this->speciality->getById($id);

        return view('category.speciality.action.edit', compact('sectors', 'speciality'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SpecialityRequest $request, string $id)
    {
        $this->speciality->update($id, $request->validated());
        return to_route('category.speciality.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->speciality->getById($id)->delete();
    }
}
