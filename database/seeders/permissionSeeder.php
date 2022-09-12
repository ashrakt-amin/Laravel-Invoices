<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class permissionSeeder extends Seeder
{
  
    public function run()
    {
        
    
    $permissions = [
    
        'invoices',
        'invoices list ',
        'paid invoices ',
        'partial paid invoices  ',
        'un paid invoices',
        'invoices archive ',
    
        'reports',
        'invoices reports ',
        'user reports ',
    
        'users',
        'users list ',
        'users permissions ',
    
        'setting',
        'products',
        'sections',
    
        'add invoice ',
        'delete invoice ',
        'EXCEL',
        'change payment status  ',
        'update invoice',
        'archive invoice',
        'print invoice',
    
        'add attachment ',
        'delete attachment ',
    
        'add user ',
        'update user ',
        'delete user ',
    
        'show permission',
        'add permission ',
        'update permission ',
        'delete permission ',
    
        'add product ',
        'update product ',
        'delete product ',
    
        'add section ',
        'update section',
        'delete section',
        
        'notifications',
    
    ];
    
    
    
    foreach ($permissions as $permission) {
    
    Permission::create(['name' => $permission]);
    
    }
    }

   

    }

