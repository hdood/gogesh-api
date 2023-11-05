<?php

namespace App\Http\Controllers\Dashboard\Ajax;

use App\Models\Seller;
use App\Models\Contact;
use App\Enum\EnumGeneral;
use Illuminate\Http\Request;
use App\Models\ContactReplie;
use App\Events\PusherBroadcast;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Ajax\LocationsResource;
use App\Http\Resources\Ajax\CategoriesResource;
use App\Http\Resources\Ajax\SubSectorResource;
use App\Models\CommercialActivity;
use App\Models\Customer;
use App\Repository\Dashboard\Ads\AdsRepository;
use App\Repository\Dashboard\Offer\OfferRepository;
use App\Repository\Dashboard\Locations\CitiesRepository;
use App\Repository\Dashboard\Locations\RegionsRepository;
use App\Repository\Dashboard\Categories\ActivityRepository;
use App\Repository\Dashboard\Categories\SpecialityRepository;
use App\Repository\Dashboard\Categories\SubSectorRepository;
use Illuminate\Support\Facades\Request as FacadesRequest;

class AjaxController extends Controller
{
    public function imageDestroy($id, $id_image, OfferRepository $offerRepository)
    {
        $offerRepository->destroyImage($id, $id_image);
    }

    public function getCity($id, CitiesRepository $city)
    {
        $cities = $city->getByCountry($id);
        return LocationsResource::collection($cities);
    }

    public function getRegion($id, RegionsRepository $region)
    {
        $regions = $region->getByCity($id);
        return LocationsResource::collection($regions);
    }
    public function autocomplete(Request $request): JsonResponse
    {
        $data = [];

        if ($request->filled('q')) {
            $data = Seller::select("firstname", "lastname", "id")
                ->where('firstname', 'LIKE', '%' . $request->get('q') . '%')
                ->Orwhere('lastname', 'LIKE', '%' . $request->get('q') . '%')
                ->where('status', EnumGeneral::ACTIVE)
                ->get();
        }

        return response()->json($data);
    }

    public function autocompleteCustomer(Request $request): JsonResponse
    {
        $data = [];

        if ($request->filled('q')) {
            $data = Customer::select("firstname", "lastname", "id")
                ->where('firstname', 'LIKE', '%' . $request->get('q') . '%')
                ->Orwhere('lastname', 'LIKE', '%' . $request->get('q') . '%')
                ->where('status', EnumGeneral::ACTIVE)
                ->get();
        }

        return response()->json($data);
    }

    public function autocompleteCommercialActivity(Request $request): JsonResponse
    {
        $data = [];

        if ($request->filled('q')) {
            $data = CommercialActivity::select("name", "id")
                ->where('name', 'LIKE', '%' . $request->get('q') . '%')
                ->where('status', EnumGeneral::APPROVED)
                ->get();
        }

        return response()->json($data);
    }

    public function getSeller()
    {
        return Seller::where('status', EnumGeneral::ACTIVE)->get();
    }
    public function getSubSector($id, SubSectorRepository $subSector)
    {
        $subSectors = $subSector->getBySectors($id);
        return CategoriesResource::collection($subSectors);
    }
    public function getActivity($id, ActivityRepository $repository)
    {
        $activities = $repository->getBySubSector($id);
        return CategoriesResource::collection($activities);
    }
    public  function getByActivity($id, ActivityRepository $repository)
    {
        $activity = $repository->getById($id);
        $data = [
            'sub_sector_id' => $activity->subSector->id,
            'sub_sector_name' => $activity->subSector->getName(),
            'sector_id' => $activity->sector->id,
            'sector_name' => $activity->sector->getName()
        ];
        return $data;
    }
    public function getSpeciality($id, SpecialityRepository $repository)
    {
        $specialities = $repository->getByActivity($id);
        return CategoriesResource::collection($specialities);
    }
    public function approved($id, Request $request, OfferRepository $offerRepository, AdsRepository $adsRepository)
    {
        if ($request->query('type') === 'offer') {
            $offerRepository->update($id, ['status' => EnumGeneral::APPROVED]);
        } elseif ($request->query('type') === 'ads') {
            $adsRepository->update($id, ['status' => EnumGeneral::APPROVED]);
        }
        return '<span class="badge rounded-pill bg-info text-light">' . EnumGeneral::NOT_PAID . '</span>';
    }
}
