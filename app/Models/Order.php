<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\Menu;

class Order extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'userId', 'roomId', 'phone', 'menuId'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
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

    // Method to get all orders
    public function getAllOrders()
    {
        return $this->findAll();
    }

    // Method to get orders by date and category
    public function getOrdersByDateAndCategory($date, $category)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('menus');

        if ($date) {
            $builder->where('date', $date);
        }

        if ($category) {
            $builder->where('category', $category);
        }

        // Execute the query and fetch menu IDs
        $menuIds = array_column($builder->get()->getResultArray(), 'id');

        // Proceed only if there are menu IDs
        if (!empty($menuIds)) {
            $builder2 = $db->table('orders');
            $builder2->whereIn('menuId', $menuIds); // Using the array of IDs

            return $builder2->get()->getResultArray();
        }

        return [];
    }
}
