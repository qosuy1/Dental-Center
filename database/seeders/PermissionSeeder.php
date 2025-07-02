<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            "عرض مستخدم",
            "إضافة مستخدم",
            "تعديل مستخدم",
            "حذف مستخدم",

            "عرض صلاحية",
            "إضافة صلاحية",
            "تعديل صلاحية",
            "حذف صلاحية",

            "عرض قسم",
            "إضافة قسم",
            "تعديل قسم",
            "حذف قسم",

            "عرض مقال",
            "إضافة مقال",
            "تعديل مقال",
            "حذف مقال",

            "عرض حالة خاصة",
            "إضافة حالة خاصة",
            "تعديل حالة خاصة",
            "حذف حالة خاصة",

            "عرض طبيب",
            "إضافة طبيب",
            "تعديل طبيب",
            "حذف طبيب",

            'إدارة الإعدادات'

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Permission::create(['name' => 'إدارة الإعدادات']);



    }
}
