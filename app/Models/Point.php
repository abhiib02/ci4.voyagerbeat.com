<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\User;

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
    protected $afterUpdate    = ['sendLoyalityUpdateNotification'];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function insertPoints(array $data)
    {
        return $this->insert($data);
    }
    public function UpdatePointsEarned(int $user_id, int $pointsEarned, string $type = '')
    {
        if (!$this->where('user_id', $user_id)->first()) {
            $data = [
                'user_id' => $user_id,
                'points_earned' => $pointsEarned,
                'points_used' => 0,
            ];
            return $this->insertPoints($data);
        }
        $result = $this->where(["user_id" => $user_id])->increment("points_earned", $pointsEarned);

        if ($result) {
            $this->sendLoyalityUpdateNotification([
                'user_id'       => $user_id,
                'points_earned' => $pointsEarned,
                'points_used'   => 0,
                'type'           => $type,
            ]);
        }
        return $result;
    }
    public function UpdatePointsUsed(int $user_id, int $pointsUsed)
    {
        return $this->where(["user_id" => $user_id])->increment("points_used", $pointsUsed);
    }

    public function AddPoints(int $user_id, int $points, string $type = '')
    {
        if (!$this->where('user_id', $user_id)->first()) {
            $data = [
                'user_id' => $user_id,
                'points_earned' => $points,
                'points_used' => 0,
            ];
            return $this->insertPoints($data);
        }
        $result = $this->where(["user_id" => $user_id])->increment("points_earned", $points);
        if ($result) {
            $this->sendLoyalityUpdateNotification([
                'user_id'       => $user_id,
                'points_earned' => $points,
                'points_used'   => 0,
                'type'           => $type,
            ]);
        }
        return $result;
    }
    public function RemovePoints(int $user_id, int $points)
    {
        return $this->where(["user_id" => $user_id])->decrement("points_earned", $points);
    }


    public function getUserPointsBalance(int $user_id)
    {
        $Points =  $this->select('points_balance')->where('user_id', $user_id)->first();
        if ($Points) {
            return $Points->points_balance ?? 0;
        }
    }
    public function getUserPointsUsed(int $user_id)
    {
        $Points =  $this->select('points_used')->where('user_id', $user_id)->first();
        if ($Points) {
            return $Points->points_used ?? 0;
        }
    }
    public function getUserOneTimePointsBalance(int $user_id)
    {
        $Points =  $this->select('points_balance')->where('user_id', $user_id)->first();
        if ($Points) {
            return ($Points->points_balance / 2) ?? 0;
        }
    }
    protected function sendLoyalityUpdateNotification(array $data)
    {
        $userModel = new User();
        $user_data = $userModel->getUserByID($data['user_id']);

        $data['user_email'] = $user_data->user_email ?? null;
        $data['user_name']  = $user_data->user_name ?? 'Valued Customer';
        $data['points_earned'] = $data['points_earned'] ?? 0;

        $emailService = service('emailService');
        $emailService->sendPointsEmail($data);
    }
}
