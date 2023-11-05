<?php

namespace App\Table\Ads;

use DataTables;
use App\Enum\EnumGeneral;
use App\Models\PlacesAds;
use Illuminate\Http\Request;
use App\Repository\Dashboard\Ads\AdsRepository;

class PlacesAdsTable
{

    public function __construct(private Request $request, private AdsRepository $repository)
    {
    }
    public function render()
    {
        if ($this->request->ajax()) {
            $data = PlacesAds::all();
            return $this->DataTable($data)->escapeColumns([])->make(true);
        }
        return view('ads.places.index');
    }
    // !tabel
    private function DataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('place', function ($data) {
                return "<a href='#!' class='show_place' id='place' data-toggle='modal' data-target='#exampleModalCenter' data-url=' " . route('places.edit', $data->id) . " '>" . __($data->place) . "</a>";
            })
            ->addColumn('price', function ($data) {
                return "<span id='span_price_$data->id'>$data->price</span>";
            })
            ->addColumn('ads', function ($data) {
                return count($data->ads);
            })
            ->addColumn('status', function ($data) {
                if ($data->status == EnumGeneral::ACTIVE) {
                    $stat = '<span class="badge rounded-pill bg-success text-light">' . __($data->status) . '</span>';
                } elseif ($data->status == EnumGeneral::INACTIVE) {
                    $stat = '<span class="badge rounded-pill bg-danger text-light ">' . __($data->status) . '</span>';
                }
                return "<span id='span_status_$data->id'> $stat</span>";
            })
            ->addColumn('action', function ($data) {

                $button = '
              <a class="btn btn-info btn-sm rounded text-light show_place" data-toggle="modal" data-target="#exampleModalCenter" data-url="' . route('places.edit', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>

            ';
                return $button;
            });
    }
}
