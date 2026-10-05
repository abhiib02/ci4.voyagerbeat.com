<?php

namespace App\Models;

use CodeIgniter\Model;

class Point extends Model
{
    protected $table            = 'user_points';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'points_earned',
        'points_used',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'user_id'            => 'required|integer',
        'points_earned'      => 'required|integer',
        'points_used'        => 'required|integer',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function insertPoints(array $data)
    {
        return $this->insert($data);
    }
    public function UpdatePointsEarned(int $user_id, int $pointsEarned)
    {
        if (!$this->where('user_id', $user_id)->first()) {
            $data = [
                'user_id' => $user_id,
                'points_earned' => $pointsEarned,
                'points_used' => 0,
            ];
            return $this->insertPoints($data);
        }
        return $this->where(["user_id" => $user_id])->increment("points_earned", $pointsEarned);
    }
    public function UpdatePointsUsed(int $user_id, int $pointsUsed)
    {
        return $this->where(["user_id" => $user_id])->increment("points_used", $pointsUsed);
    }

    public function getUserPointsBalance(int $user_id)
    {
        $Points =  $this->select('points_balance')->where('user_id', $user_id)->first();
        if ($Points) {
            return $Points->points_balance ?? 0;
        }
    }
    public function getUserOneTimePointsBalance(int $user_id)
    {
        $Points =  $this->select('points_balance')->where('user_id', $user_id)->first();
        if ($Points) {
            return ($Points->points_balance / 2) ?? 0;
        }
    }
}
