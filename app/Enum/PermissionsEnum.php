<?php

namespace App\Enum;

enum PermissionsEnum: string
{
    case view_user = "عرض مستخدم";
    case create_user = "إضافة مستخدم";
    case edit_user = "تعديل مستخدم";
    case delete_user = "حذف مستخدم";

    case view_role = "عرض صلاحية";
    case create_role = "إضافة صلاحية";
    case edit_role = "تعديل صلاحية";
    case delete_role = "حذف صلاحية";

    case view_department = "عرض قسم";
    case create_department = "إضافة قسم";
    case edit_department = "تعديل قسم";
    case delete_department = "حذف قسم";

    case view_blog = "عرض مقال";
    case create_blog = "إضافة مقال";
    case edit_blog = "تعديل مقال";
    case delete_blog = "حذف مقال";

    case view_case = "عرض حالة خاصة";
    case create_case = "إضافة حالة خاصة";
    case edit_case = "تعديل حالة خاصة";
    case delete_case = "حذف حالة خاصة";

    case view_doctor = "عرض طبيب";
    case create_doctor = "إضافة طبيب";
    case edit_doctor = "تعديل طبيب";
    case delete_doctor = "حذف طبيب";


    case settings = 'إدارة الإعدادات' ;
}
