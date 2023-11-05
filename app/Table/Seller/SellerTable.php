<?php

namespace App\Table\Seller;

use DataTables;
use App\Enum\EnumGeneral;
use Illuminate\Http\Request;
use App\Repository\Dashboard\SellerRepository;

class SellerTable
{
    public function __construct(private Request $request, private SellerRepository $repository)
    {
    }
    public function render()
    {
        if ($this->request->ajax()) {
            $data = $this->repository->all();
            return $this->DataTable($data)->escapeColumns([])->make(true);
        }
        return view('seller.index');
    }
    // !tabel
    private function DataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('image', function ($data) {
                $icon = "";
                if ($data->type == EnumGeneral::COMPANY) {
                    $icon = "<svg style='position:absolute;right:-5px;top: -10px;' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none'>
                    <path d='M10.75 2.45007C11.44 1.86007 12.57 1.86007 13.27 2.45007L14.85 3.81007C15.15 4.07007 15.71 4.28007 16.11 4.28007H17.81C18.87 4.28007 19.74 5.15007 19.74 6.21007V7.91007C19.74 8.30007 19.95 8.87007 20.21 9.17007L21.57 10.7501C22.16 11.4401 22.16 12.5701 21.57 13.2701L20.21 14.8501C19.95 15.1501 19.74 15.7101 19.74 16.1101V17.8101C19.74 18.8701 18.87 19.7401 17.81 19.7401H16.11C15.72 19.7401 15.15 19.9501 14.85 20.2101L13.27 21.5701C12.58 22.1601 11.45 22.1601 10.75 21.5701L9.17 20.2101C8.87 19.9501 8.31 19.7401 7.91 19.7401H6.18C5.12 19.7401 4.25 18.8701 4.25 17.8101V16.1001C4.25 15.7101 4.04 15.1501 3.79 14.8501L2.44 13.2601C1.86 12.5701 1.86 11.4501 2.44 10.7601L3.79 9.17007C4.04 8.87007 4.25 8.31007 4.25 7.92007V6.20007C4.25 5.14007 5.12 4.27007 6.18 4.27007H7.91C8.3 4.27007 8.87 4.06007 9.17 3.80007L10.75 2.45007Z' fill='white' stroke='#007bff' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/>
                    <path d='M8.38 12.0001L10.79 14.4201L15.62 9.58008' stroke='#007bff' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/>
                    <defs>
                    <linearGradient id='paint0_linear_15_331' x1='2.00502' y1='22.0126' x2='21.5801' y2='1.59306' gradientUnits='userSpaceOnUse'>
                    <stop stop-color='#209950'/>
                    <stop offset='1' stop-color='#14B2BC'/>
                    </linearGradient>
                    <linearGradient id='paint1_linear_15_331' x1='8.38' y1='14.4201' x2='12.6871' y2='7.70022' gradientUnits='userSpaceOnUse'>
                    <stop stop-color='#209950'/>
                    <stop offset='1' stop-color='#14B2BC'/>
                    </linearGradient>
                    </defs>
                    </svg>
                    ";
                }
                $img = !empty($data->image) ? asset($data->image) : asset('static/img/admin.jpg');
                return "<span style='position:relative'><img class='rounded-circle' src='" . $img  . "' alt='customer' style='
                width: 35px;
                height: 35px;
            '>$icon</span>";
            })
            ->addColumn('name', function ($data) {
                return "<a href='" . route('seller.edit', $data->id) . "'>" . $data->firstname . ' ' . $data->lastname . "</a>";
            })
            ->addColumn('verification', function ($data) {
                if ($data->verification == 1) {
                    $stat = '<span class="badge rounded-pill bg-success text-light">' . __('True') . '</span>';
                } else {
                    $stat = '<span class="badge rounded-pill bg-danger text-light">' . __('False') . '</span>';
                }
                return $stat;
            })
            ->addColumn('commercial', function ($data) {
                if ($data->commercial_activity_name) {
                    return "<a >" . $data->commercial_activity_name . "</a>";
                }
                return __('Not Has');
            })
            ->addColumn('email', function ($data) {
                return $data->email;
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
                } elseif ($data->status == EnumGeneral::PENDING) {
                    $stat = '<span class="badge rounded-pill bg-info text-light">' . __($data->status) . '</span>';
                } elseif ($data->status == EnumGeneral::REJECTED) {
                    $stat = '<span class="badge rounded-pill bg-warning text-light">' . __($data->status) . '</span>';
                } elseif ($data->status == EnumGeneral::UPDATED) {
                    $stat = '<span id="spanStatus_' . $data->id . '"><span class="badge rounded-pill bg-info text-light">' . __($data->status) . '</span></span>';
                }
                return $stat;
            })
            ->addColumn('action', function ($data) {
                if ($data->status == EnumGeneral::PENDING) {
                    $approved = '<a class="btn btn-success btn-sm rounded text-light"  data-url="' . route('seller.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-check"></i></a>';
                } else {
                    $approved = '';
                }
                $button = '
              <a class="btn btn-info btn-sm rounded" href="' . route('seller.edit', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-edit"></i></a>
              <a class="btn btn-danger btn-sm rounded text-light" id="del" data-url="' . route('seller.destroy', $data->id) . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a>
                ' . $approved . '

            ';
                return $button;
            });
    }
}
