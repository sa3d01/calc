<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DropDownCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [];
        foreach ($this as $obj) {
            $arr['id'] = (int)$obj->id;
            $arr['name'] = $obj->name;
            if($obj->class=="ClinicalStatus"){
                $arr['stress_factor_from'] = $obj->stress_factor_from??"";
                $arr['stress_factor_to'] = $obj->stress_factor_to??"";
            }
            $data[] = $arr;
        }
        return $data;
    }
}
