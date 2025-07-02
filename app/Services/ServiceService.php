<?php

namespace App\Services;

use App\Models\Department;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class ServiceService extends Controller
{
    function createService(Request $request, Department $department)
    {

        $services = explode('-', $request->input('services'));
        $request['services'] = $services;

        // Validate that services is an array and required
        $validated = $request->validate([
            'services' => ['array', 'required'],
        ]);

        // Now $validated['services'] contains the clean array
        $dataArray = [];
        foreach ($validated['services'] as $service) {
            $serviceArray = explode(':', $service);
            $dataArray[] = [
                'name' => $serviceArray[0],
                'smallDesc' => $serviceArray[1] ?? null,
                'department_id' => $department->id
            ];
        }

        //         الحذف الكامل	 عدد الخدمات قليل، والكود بسيط، والتعديلات نادرة.
        // المقارنة الذكية	عدد الخدمات كبير أو تحتاج الحفاظ على ID الخدمة، أو تريد تحسين الأداء قدر الإمكان.

        $department->services()->delete();

        Service::insert($dataArray);
    }


    function getDepartmentServicesToedit(Department $department)
    {

        $servicesString = "";
        foreach ($department->services as $service) {
            $servicesString .= $service->name;
            if ($service->smallDesc)
                $servicesString .= ':' . $service->smallDesc;
            $servicesString .= " - ";
        }

        $servicesString = rtrim($servicesString, ' - ');

        if (empty($servicesString))
            return "";

        return $servicesString;
    }
}
