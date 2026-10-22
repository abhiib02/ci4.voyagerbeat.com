<?php

namespace App\Models;

use CodeIgniter\Model;

class Package extends Model
{

    protected $table            = 'packages';
    protected $primaryKey       = 'PACKAGE_ID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields    = [
        'HIDDEN',
        'SLUG',
        'LOCATION',
        'STATE',
        'COUNTRY',
        'PICKNDROP',
        'WHATSAPP_LINK',
        'HOTEL_IMG_LINK',
        'PACKAGE_DAYS',
        'STAY',
        'DURATION',
        'PACKAGE_TYPE',
        'CATEGORY',
        'TAGS',
        'BADGE',
        'FAVORITE_COUNT',
        'PACKAGE_PDF',
        'WEEKEND',
        'UPCOMING',
        'INCLUSION',
        'EXCLUSION',
        'PACK_IT',
        'PACKAGE_NAME',
        'PACKAGE_IMAGE',
        'PACKAGE_THUMBNAIL',
        'SPACIAL_OFFER',
        'BOOKING_AMOUNT',
        'REQUEST_PRICE',
        'PRICE_1',
        'PRICE_2',
        'PRICE_3',
        'PRICE_4',
        'PRICE_5',
        'S_PRICE_1',
        'S_PRICE_2',
        'S_PRICE_3',
        'S_PRICE_4',
        'S_PRICE_5',
        'WT_PRICE_1',
        'WT_PRICE_2',
        'WT_PRICE_3',
        'WT_PRICE_4',
        'WT_PRICE_5',
        'WT2_PRICE_1',
        'WT2_PRICE_2',
        'WT2_PRICE_3',
        'WT2_PRICE_4',
        'WT2_PRICE_5',
        'INFO_P1',
        'INFO_P2',
        'INFO_P3',
        'INFO_P4',
        'INFO_P5',
        'HEAD_PRICE',
        'HEAD_WTPRICE',
        'HEAD_WT2PRICE',
        'TRIP_HIGHLIGHT',
        'META_DESC',
        'CUSTOM_TRIP',
        'DATES',
        'IMAGE_1',
        'IMAGE_2',
        'IMAGE_3',
        'IMAGE_4',
        'PACKAGE_MISC',
        'PACKAGE_TNC',
        'PACKAGE_FAQ',
        'updated_at',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'LOCATION'          => 'required',
        'STATE'             => 'required',
        'COUNTRY'           => 'required',
        'PICKNDROP'         => 'required',
        'PACKAGE_DAYS'      => 'required',
        'STAY'              => 'required',
        'DURATION'          => 'required|integer',
        'PACKAGE_TYPE'      => 'required',
        'WEEKEND'           => 'required',
        'INCLUSION'         => 'required',
        'EXCLUSION'         => 'required',
        'PACK_IT'           => 'required',
        'PACKAGE_NAME'      => 'required',
        'PACKAGE_IMAGE'     => 'required',
        'PACKAGE_THUMBNAIL' => 'required',
        'SLUG'              => 'permit_empty|is_unique[packages.SLUG,PACKAGE_ID,{PACKAGE_ID}]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;


    public function insertPackage(array $data)
    {
        return $this->insert($data);
    }

    public function UpdatePackage($id, $data)
    {
        return (bool) $this->builder()->where(["PACKAGE_ID" => $id])->set($data)->update();
    }

    public function getPackagesByField(string $selectString, string $whereColumn, string $whereData)
    {
        return $this->select($selectString)->where($whereColumn, $whereData)->where('HIDDEN', 0)->findAll();
    }

    public function getAllPackages(string $direction = 'DESC', int $perPage = 15, string $group = 'default'): array
    {
        return $this->where('HIDDEN', 0)->orderBy('PACKAGE_ID', $direction)->paginate($perPage, $group);
    }
    public function getAllPackagesInMobile(string $direction = 'DESC'): array
    {
        return $this->where('HIDDEN', 0)->orderBy('PACKAGE_ID', $direction)->find();
    }

    public function getAllPackagesForAdminDashboard(int $perPage = 15, string $group = 'default'): array
    {
        return $this->select('PACKAGE_ID, SLUG, PACKAGE_NAME, LOCATION, DATES, updated_at')->orderBy('updated_at', 'DESC')->find(); //->paginate($perPage, $group);
    }

    public function getAllPackagesNameAndID(): array
    {
        return $this->select('PACKAGE_ID, PACKAGE_NAME, PACKAGE_IMAGE')->where('HIDDEN', 0)->orderBy('PACKAGE_ID', 'DESC')->findAll();
    }
    public function getAllPackagesCount(): int
    {
        return $this->countAllResults();
    }
    public function getAllShowPackagesCount(): int
    {
        return $this->where('HIDDEN', 0)->countAllResults();
    }
    public function getAllHoneymoonPackages(): array
    {
        return $this->where('CATEGORY', 'honeymoon')->where('HIDDEN', 0)->findAll();
    }

    public function isSlugExist(string $slug): bool
    {
        return $this->where('SLUG', $slug)->countAllResults() > 0;
    }
    public function getIDfromSlug(string $slug)
    {
        $package = $this->select('PACKAGE_ID')->where('SLUG', $slug)->first();
        return $package ? $package->PACKAGE_ID : null;
    }
    public function isPackageExist(int $ID): bool
    {
        return $this->where('PACKAGE_ID', $ID)->countAllResults() > 0;
    }
    public function getPackageBySlug(string $slug)
    {
        return $this->where('SLUG', $slug)->first();
    }
    public function getPackageByType(string $type): array
    {
        return $this->where('PACKAGE_TYPE', $type)->where('HIDDEN', 0)->findAll();
    }
    public function getPackagesByDestination(string $destination): array
    {
        return $this->where('LOCATION', $destination)->findAll();
    }
    public function getHiddenPackages(string $direction = 'ASC'): array
    {
        return $this->where('HIDDEN', 1)->orderBy('PACKAGE_ID', $direction)->findAll();
    }

    public function getPackageByID(int $ID)
    {
        return $this->find($ID);
    }
    public function getPackageDatesByID(int $ID)
    {
        return $this->select('DATES')->find($ID);
    }
    public function getPackageByIDForSearch(int $ID): array
    {
        return $this->where('PACKAGE_ID', $ID)->findAll();
    }
    public function getPackagesByName(string $name): array
    {
        return $this->like('PACKAGE_NAME', $name)->findAll();
    }
    public function getPackagesByUpcoming(string $direction = 'DESC', int $perPage = 15, string $group = 'default'): array
    {
        return $this->where('UPCOMING', 1)->where('HIDDEN', 0)->orderBy('PACKAGE_ID', 'DESC')->paginate($perPage, $group);
    }
    public function getPackagesByCategory(string $Cat): array
    {
        return $this->where('CATEGORY', $Cat)->where('HIDDEN', 0)->findAll();
    }
    public function getSimilarPackages(string $location, string $type): array
    {
        $builder = $this->select('PACKAGE_NAME,PACKAGE_DAYS,PACKAGE_IMAGE,SLUG,PRICE_1,REQUEST_PRICE')->groupStart()->where('LOCATION', $location)->orWhere('PACKAGE_TYPE', $type)->groupEnd()->where('HIDDEN', '0');

        return $builder->orderBy('PACKAGE_ID', 'DESC')->findAll(8);
    }
    public function getPackagesByBadge(string $Badge): array
    {
        return $this->where('BADGE', $Badge)->where('HIDDEN', 0)->findAll();
    }
    public function getPackagesByState(string $State): array
    {
        return $this->where('STATE', $State)->where('HIDDEN', 0)->findAll();
    }
    public function getPackagesByCountry(string $Country): array
    {
        return $this->where('COUNTRY', $Country)->where('HIDDEN', 0)->findAll();
    }
    public function getPackagesByLikes(int $perPage = 15, string $group = 'default'): array
    {
        return $this->where('FAVORITE_COUNT >', 0)
            ->where('HIDDEN', 0)
            ->orderBy('FAVORITE_COUNT', 'DESC')
            ->paginate($perPage, $group);
    }

    public function getPackagesByTag(string $tag): array
    {
        return $this->like('TAGS', $tag)->where('HIDDEN', 0)->findAll();
    }
    public function getPackagesByNights(string $nights): array
    {
        return $this->like('STAY', $nights)->where('HIDDEN', 0)->findAll();
    }
    public function getPackagesByNightsWeekend(string $nights): array
    {
        return $this->like('STAY', $nights)->where('WEEKEND', 'Yes')->where('HIDDEN', 0)->findAll();
    }
    public function getPackagesByNightsandLocation(string $nights, string $location): array
    {
        return $this->where('LOCATION', $location)->like('STAY', $nights)->where('HIDDEN', 0)->findAll();
    }
    public function getAllDistinctTags(): array
    {
        $rows = $this->select('TAGS')->where('TAGS IS NOT NULL')->findAll();
        $allTags = [];

        foreach ($rows as $row) {
            $tagString = is_object($row) ? $row->TAGS : ($row['TAGS'] ?? '');
            if (!empty($tagString)) {
                $tags = array_map('trim', explode(',', $tagString));
                $allTags = array_merge($allTags, $tags);
            }
        }
        $distinctTags = array_values(array_unique(array_filter($allTags)));
        sort($distinctTags);

        return $distinctTags;
    }
    public function getAllDistinctType(): array
    {
        $rows = $this->select('PACKAGE_TYPE')
            ->distinct()
            ->where('PACKAGE_TYPE IS NOT NULL')
            ->where("PACKAGE_TYPE != ''")
            ->findAll();

        $types = array_map(static function ($row) {
            return is_object($row) ? $row->PACKAGE_TYPE : $row['PACKAGE_TYPE'];
        }, $rows);

        sort($types);

        return $types;
    }
    public function getAllDistinctBadges(): array
    {
        $rows = $this->select('BADGE')
            ->distinct()
            ->where('BADGE IS NOT NULL')
            ->where("BADGE != ''")
            ->findAll();

        $badges = array_map(static function ($row) {
            return is_object($row) ? $row->BADGE : $row['BADGE'];
        }, $rows);

        sort($badges);

        return $badges;
    }
    public function getAllDistinctStates(): array
    {
        $rows = $this->select('STATE')
            ->distinct()
            ->where('STATE IS NOT NULL')
            ->where("STATE != ''")
            ->findAll();

        $states = array_map(static function ($row) {
            return is_object($row) ? $row->STATE : $row['STATE'];
        }, $rows);

        sort($states);

        return $states;
    }
    public function getAllDistinctCountry(): array
    {
        $rows = $this->select('COUNTRY')
            ->distinct()
            ->where('COUNTRY IS NOT NULL')
            ->where("COUNTRY != ''")
            ->findAll();

        $countries = array_map(static function ($row) {
            return is_object($row) ? $row->COUNTRY : $row['COUNTRY'];
        }, $rows);

        sort($countries);

        return $countries;
    }
    public function getAllDomesticDestination()
    {
        return $this->select('LOCATION,ANY_VALUE(PACKAGE_IMAGE) as PACKAGE_IMAGE')->groupBy('LOCATION')->where("HIDDEN", 0)->where('STATE !=', 'International')->findAll();
    }


    public function getFavoritecount(int $ID): int
    {
        $package = $this->select('FAVORITE_COUNT')->find($ID);

        if ($package === null) {
            return 0;
        }
        return (int) (is_object($package) ? $package->FAVORITE_COUNT : ($package['FAVORITE_COUNT'] ?? 0));
    }

    public function UpdateFavoriteCount(int $ID, int $Value): int
    {
        return (bool) $this->builder()->where('PACKAGE_ID', $ID)->set('FAVORITE_COUNT', 'FAVORITE_COUNT + ' . $Value, false)->update();
    }

    public function deletePackageByID(int $ID): bool
    {
        if ($this->find($ID) !== null) {
            return (bool) $this->delete($ID);
        }
        return false;
    }
    /// Custom Functions with Exact Details For Which Use

    // Function to get honeymoon packages
    public function getPackagesByTagForNav(string $tag): array
    {
        return $this->select('PACKAGE_NAME,SLUG,PACKAGE_DAYS')->like('TAGS', $tag)->where('HIDDEN', 0)->limit(6)->find();
    }
}
