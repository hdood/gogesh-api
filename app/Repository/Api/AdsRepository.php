<?php

namespace App\Repository\Api;

use DataTables;
use App\Models\Ads;
use App\Enum\EnumGeneral;
use App\Models\AdsView;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Type\Integer;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use function PHPUnit\Framework\isNull;

final class AdsRepository
{
    protected $model;

    public function __construct(Ads $ads, private AdsView $adsView)
    {
        $this->model = $ads;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->findOrfail($id);
    }

    public function addView($array)
    {
        $this->adsView->create($array);
    }

    public function getByIdApproved($id)
    {
        return $this->model->withCount("views")
            ->with("commercialActivity")->where('status', EnumGeneral::APPROVED)->whereid($id)->firstOrfail();
    }

    public function getPaginatedAds($status = EnumGeneral::APPROVED, $type = null,): LengthAwarePaginator
    {
        if ($type) {
            return $this->model->whereHas('commercialActivity', function ($query) use ($type) {
                $query->where('type', $type)->where('status', EnumGeneral::APPROVED);
            })->Orwhere('poster_type', $type)->where("place", EnumGeneral::ADS_SECREEN)->where('status', $status)->paginate(15);
        }
        return $this->model->withCount("views")->where('status', EnumGeneral::APPROVED)->where("place", EnumGeneral::ADS_SECREEN)->latest()->paginate(15);
    }

    public function getSectorFlashAd($sector)
    {
        $query = $this->model->query();
        $query->where('status', EnumGeneral::APPROVED);
        $query->where('sector_id', $sector);
        $query->where('place', EnumGeneral::SECTOR_FLASH);
        return $query->inRandomOrder()->firstOrFail();
    }

    public function getSectorsBannerAds()
    {
        $query = $this->model->query();
        $query->where('status', EnumGeneral::APPROVED);
        $query->where('place', EnumGeneral::SECTORS_BANER);
        return $query->paginate(16);
    }

    public function getSectorBannerAds($sector)
    {
        $query = $this->model->query();
        $query->where('status', EnumGeneral::APPROVED);
        $query->where('place', EnumGeneral::SECTOR_BANER);
        $query->where('sector_id', $sector);

        return $query->paginate(16);
    }

    public function getHomeFlashAd()
    {
        $query = $this->model->query();
        $query->where('status', EnumGeneral::APPROVED);
        $query->where('place', EnumGeneral::HOME_FLASH);
        return $query->inRandomOrder()->firstOrFail();
    }

    public function getHomeBannerAds()
    {
        $query = $this->model->query();
        $query->where('status', EnumGeneral::APPROVED);
        $query->where('place', EnumGeneral::HOME_BANER);
        return $query->paginate(16);
    }

    public function getSearchBannerAds()
    {
        $query = $this->model->query();
        $query->where('status', EnumGeneral::APPROVED);
        $query->where('place', EnumGeneral::SEARCH_BANER);
        return $query->paginate(16);
    }


    public function getPaginatedAdsBySeller($status): LengthAwarePaginator
    {
        if ($status) {
            return $this->model->where('seller_id', Auth::id())->where('status', $status)->paginate(15);
        }
        return $this->model->where('seller_id', Auth::id())->paginate(15);
    }

    public function Null(string $value)
    {
        return $this->model->whereNull($value)->get();
    }

    public function update($id, array $array)
    {
        $ads = $this->model->findOrfail($id);
        $ads->update($array);
    }

    public function create($array)
    {
        return $this->model->create($array);
    }

    public function destroyImage($id, $id_image)
    {
        $ads = $this->model->findOrfail($id);
        $images = json_decode($ads->images, true);

        unset($images[$id_image]);
        $images_arr = [];
        foreach ($images as $key => $image) {
            $images_arr[] = $image;
        }
        $ads->images = json_encode($images_arr);
        $ads->save();
    }
}
