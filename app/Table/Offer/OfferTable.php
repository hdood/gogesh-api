<?php

namespace App\Table\Offer;

use App\Enum\EnumGeneral;
use DataTables;
use Illuminate\Http\Request;
use App\Repository\Dashboard\Offer\OfferRepository;

class OfferTable
{

    public function __construct(private Request $request, private OfferRepository $repository)
    {
    }
    public function render()
    {
        if ($this->request->ajax()) {
            $data = $this->repository->all();
            return $this->DataTable($data)->escapeColumns([])->make(true);
        }
        return view('offer.index');
    }
    // !tabel
    private function DataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('title', function ($data) {
                return "<a href='" . route('offer.edit', $data->id) . "'>$data->title</a>";
            })
            ->addColumn('price', function ($data) {
                return $data->price;
            })
            ->addColumn('sector', function ($data) {
                return $data->seller->sector->getName();
            })
            ->addColumn('created_at', function ($data) {
                if ($data->created_at) {
                    return $data->created_at->format('d/m/Y');
                }
                return '';
            })
            ->addColumn('seller', function ($data) {
                return "<a href='" . route('seller.edit', $data->seller->id) . "'>" . $data->seller->commercial_activity_name . "</a>";
            })
            ->addColumn('status', function ($data) {
                if ($data->status == EnumGeneral::APPROVED) {
                    $stat = '<span id="spanStatus_' . $data->id . '"><span class="badge rounded-pill bg-success text-light">' . __($data->status) . '</span></span>';
                } elseif ($data->status == EnumGeneral::REJECTED) {
                    $stat = '<span id="spanStatus_' . $data->id . '"><span class="badge rounded-pill bg-danger text-light">' . __($data->status) . '</span></span>';
                } elseif ($data->status == EnumGeneral::PENDING) {
                    $stat = '<span id="spanStatus_' . $data->id . '"><span class="badge rounded-pill bg-warning text-light">' . __($data->status) . '</span></span>';
                } elseif ($data->status == EnumGeneral::UPDATED) {
                    $stat = '<span id="spanStatus_' . $data->id . '"><span class="badge rounded-pill bg-info text-light">' . __($data->status) . '</span></span>';
                } elseif ($data->status == EnumGeneral::DRAFT) {
                    $stat = '<span id="spanStatus_' . $data->id . '"><span class="badge rounded-pill bg-info text-light">' . __($data->status) . '</span></span>';
                } elseif ($data->status == EnumGeneral::NOT_PAID) {
                    $stat = '<span id="spanStatus_' . $data->id . '"><span class="badge rounded-pill bg-info text-light">' . __($data->status) . '</span></span>';
                }
                return $stat;
            })
            ->addColumn('action', function ($data) {
                if ($data->status == EnumGeneral::PENDING) {
                    $approved = '<a class="btn btn-success btn-sm rounded text-light"  id="approved" data-url="' . route('ajax.approved', $data->id) . '?type=offer" data-id="' . $data->id . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-check"></i></a>';
                } else {
                    $approved = '';
                }
                $button = '
              <a class="btn btn-info btn-sm rounded" href="' . route('offer.edit', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
              <a class="btn btn-danger btn-sm rounded text-light" id="del" data-url="' . route('offer.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                ' . $approved . '
            ';
                return $button;
            });
    }
}
