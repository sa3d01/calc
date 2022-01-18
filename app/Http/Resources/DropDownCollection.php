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
                $arr['strees_factor_from'] = $obj->strees_factor_from;
                $arr['strees_factor_to'] = $obj->strees_factor_to;
            }
            $data[] = $arr;
        }
        return $data;
    }
}
