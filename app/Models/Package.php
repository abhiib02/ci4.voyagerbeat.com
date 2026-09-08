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
        'COUNTRY'           => 'required',
        'PICKNDROP'         => 'required',
        'WHATSAPP_LINK'     => 'required',
        'PACKAGE_DAYS'      => 'required',
        'STAY'              => 'required',
        'DURATION'          => 'required|integer',
        'PACKAGE_TYPE'      => 'required',
        'CATEGORY'          => 'required',
        'TAGS'              => 'required',
        'BADGE'             => 'required',
        'FAVORITE_COUNT'    => 'required|integer',
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


    public function insertPackage($data)
    {
        $db = \Config\Database::connect();
        return $db->table('Packages')->insert($data);
    }

    public function UpdatePackage($id, $data)
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->where(["PACKAGE_ID" => $id]);
        $builder->set($data);
        $builder->update();
    }

    public function getAllPackages()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $builder->orderBy('updated_at', 'DESC');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function getAllPackagesForAdminDashboard(int $perPage = 15, string $group = 'default'): array
    {
        return $this->select('PACKAGE_ID, SLUG, PACKAGE_NAME, LOCATION, updated_at')
            ->orderBy('updated_at', 'DESC')
            ->paginate($perPage, $group);
    }

    public function getAllPackagesNameAndID()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('PACKAGE_ID,PACKAGE_NAME');
        $builder->where('HIDDEN', 0);
        $builder->orderBy('updated_at', 'DESC');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }

    public function getAllPackagesCount()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $query = $builder->get();
        $result = $query->getNumRows();
        return $result;
    }
    public function getAllHoneymoonPackages()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $builder->where('CATEGORY', 'honeymoon');
        $query = $builder->get();
        $result = $query->getResultObject();
        return $result;
    }

    public function isSlugExist($slug)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $builder->where('SLUG', $slug);
        $query = $builder->get();
        $result = $query->getRowArray();
        if ($result !== null) {
            return 1;
        }
        return 0;
    }
    public function getIDfromSlug($slug)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('PACKAGE_ID');
        $builder->where('SLUG', $slug);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function isPackageExist($ID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $builder->where('PACKAGE_ID', $ID);
        $query = $builder->get();
        $result = $query->getRowArray();
        if ($result !== null) {
            return 1;
        }
        return 0;
    }

    public function getPackageBySlug($slug)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $builder->where('SLUG', $slug);
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function getPackageByType($type)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $builder->where('PACKAGE_TYPE', $type);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function getPackagesByDestination($destination)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $builder->where('LOCATION', $destination);
        $query = $builder->get();
        $result = $query->getResultObject();
        return $result;
    }
    public function getHiddenPackages(string $direction = 'ASC'): array
    {
        return $this->where('HIDDEN', 1)->orderBy('updated_at', $direction)->findAll();
    }
    public function getPackageByID($ID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $builder->where('PACKAGE_ID', $ID);
        $query = $builder->get();
        $result = $query->getRow();
        return $result;
    }
    public function getPackageByIDForSearch($ID)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $builder->where('PACKAGE_ID', $ID);
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function getPackagesByName($name)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $builder->like("PACKAGE_NAME", htmlspecialchars($name));
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function getPackagesByUpcoming()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $builder->where('UPCOMING', 1);
        $builder->where('HIDDEN', 0);
        $builder->orderBy('updated_at', 'DESC');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
    public function getPackagesByCategory($Cat)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $builder->where('CATEGORY', $Cat);
        $query = $builder->get();
        $result = $query->getResultObject();
        return $result;
    }
    public function getPackagesByBadge($Badge)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $builder->where('BADGE', $Badge);
        $query = $builder->get();
        $result = $query->getResultObject();
        return $result;
    }
    public function getPackagesByState($State)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $builder->where('STATE', $State);
        $query = $builder->get();
        $result = $query->getResultObject();
        return $result;
    }
    public function getPackagesByCountry($Country)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $builder->where('COUNTRY', $Country);
        $query = $builder->get();
        $result = $query->getResultObject();
        return $result;
    }

    public function getPackagesByTag($tag)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $builder->like("TAGS", htmlspecialchars($tag));
        $query = $builder->get();
        $result = $query->getResultObject();
        return $result;
    }
    public function getPackagesByNights($nights)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('*');
        $builder->like("STAY", htmlspecialchars($nights));
        $query = $builder->get();
        $result = $query->getResultObject();
        return $result;
    }
    public function getAllDistinctTags()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('TAGS');
        $query = $builder->get();
        $result = $query->getResultArray();
        $allTags = [];
        foreach ($result as $row) {
            if (!empty($row['TAGS'])) {
                $tags = array_map('trim', explode(',', $row['TAGS']));
                $allTags = array_merge($allTags, $tags);
            }
        }

        $distinctTags = array_unique($allTags);
        sort($distinctTags);
        return $distinctTags;
    }
    public function getAllDistinctBadges()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('BADGE');
        $builder->distinct();
        $builder->where('BADGE IS NOT NULL');
        $query = $builder->get();
        $result = $query->getResultObject();
        $BadgesArr = [];
        foreach ($result as $row) {
            array_push($BadgesArr, $row->BADGE);
        }
        sort($BadgesArr);
        return $BadgesArr;
    }
    public function getAllDistinctStates()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('STATE');
        $builder->distinct();
        $builder->where('STATE IS NOT NULL');
        $query = $builder->get();
        $result = $query->getResultObject();
        $StatesArr = [];
        foreach ($result as $row) {
            array_push($StatesArr, $row->STATE);
        }
        sort($StatesArr);
        return $StatesArr;
    }
    public function getAllDistinctCountry()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('Packages');
        $builder->select('COUNTRY');
        $builder->distinct();
        $builder->where('COUNTRY IS NOT NULL');
        $query = $builder->get();
        $result = $query->getResultObject();
        $CountryArr = [];
        foreach ($result as $row) {
            array_push($CountryArr, $row->COUNTRY);
        }
        sort($CountryArr);
        return $CountryArr;
    }



    public function deletePackageByID($ID)
    {
        if ($this->isPackageExist($ID)) {
            $db = \Config\Database::connect();
            $builder = $db->table('Packages');
            $builder->where('ID', $ID);
            $builder->delete();
            return 1;
        } else {
            return 0;
        }
    }
}
