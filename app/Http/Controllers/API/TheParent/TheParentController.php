<?php

namespace App\Http\Controllers\API\TheParent;

use App\Http\Controllers\Controller;
use App\Models\ParentAttechment;
use App\Models\TheParent;
use Illuminate\Http\Request;

class TheParentController extends Controller
{
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'father_name' => ['required', 'string'],
            'father-national_id' => ['required', 'string', 'unique:the_parents,father-national_id'],
            'father_passport_id' => ['required', 'string'],
            'father_phone' => ['required', 'string'],
            'father_job' => ['required', 'string'],
            'father_nationalitie_id' => ['required', 'exists:nationalities,id'],
            'father_blood_id' => ['required', 'exists:bloods,id'],
            'father_religion_id' => ['required', 'exists:religions,id'],
            'mother_name' => ['required', 'string'],
            'mother-national_id' => ['required', 'string', 'unique:the_parents,mother-national_id'],
            'mother_passport_id' => ['required', 'string'],
            'mother_phone' => ['required', 'string'],
            'mother_job' => ['required', 'string'],
            'mother_nationalitie_id' => ['required', 'exists:nationalities,id'],
            'mother_blood_id' => ['required', 'exists:bloods,id'],
            'mother_religion_id' => ['required', 'exists:religions,id'],
        ]);
 
        $theParent = TheParent::create($validatedData);

        if (!empty($request['photos'])) {

            foreach ($request['photos'] as $photo) {

                $photo->storeAs($theParent['id'], $photo->getClientOriginalName(), $disk = 'parent_attachment');
                ParentAttechment::create([
                    'photo' => $photo->getClientOriginalName(),
                    'parent_id' => $theParent['id']
                ]);
            }
        }
        return response()->json(['data' => $theParent, 'message' => 'TheParent created successfully']);
    }

    /**
     * update parents information
     */
    public function update(Request $request, TheParent $parent)
    {
        $request->validate([
            'father_name' => ['string'],
            'father-national_id' => ['string', 'unique:the_parents,father-national_id'],
            'father_passport_id' => ['string'],
            'father_phone' => ['string'],
            'father_job' => ['string'],
            'father_nationalitie_id' => ['exists:nationalities,id'],
            'father_blood_id' => ['exists:bloods,id'],
            'father_religion_id' => ['exists:religions,id'],
            'mother_name' => ['string'],
            'mother-national_id' => ['string', 'unique:the_parents,mother-national_id'],
            'mother_passport_id' => ['string'],
            'mother_phone' => ['string'],
            'mother_job' => ['string'],
            'mother_nationalitie_id' => ['exists:nationalities,id'],
            'mother_blood_id' => ['exists:bloods,id'],
            'mother_religion_id' => ['exists:religions,id'],
        ]);

        $parent->update([
            'father_name' => ($request['father_name']) ? $request['father_name'] : $parent['father_name'],
            'father-national_id' => ($request['father-national_id']) ? $request['father-national_id'] : $parent['father-national_id'],
            'father_passport_id' => ($request['father_passport_id']) ? $request['father_passport_id'] : $parent['father_passport_id'],
            'father_phone' => ($request['father_phone']) ? $request['father_phone'] : $parent['father_phone'],
            'father_job' => ($request['father_job']) ? $request['father_job'] : $parent['father_job'],
            'father_nationalitie_id' => ($request['father_nationalitie_id']) ? $request['father_nationalitie_id'] : $parent['father_nationalitie_id'],
            'father_blood_id' => ($request['father_blood_id']) ? $request['father_blood_id'] : $parent['father_blood_id'],
            'father_religion_id' => ($request['father_religion_id']) ? $request['father_religion_id'] : $parent['father_religion_id'],
            'mother_name' => ($request['mother_name']) ? $request['mother_name'] : $parent['mother_name'],
            'mother-national_id' => ($request['mother-national_id']) ? $request['mother-national_id'] : $parent['mother-national_id'],
            'mother_passport_id' => ($request['mother_passport_id']) ? $request['mother_passport_id'] : $parent['mother_passport_id'],
            'mother_phone' => ($request['mother_phone']) ? $request['mother_phone'] : $parent['mother_phone'],
            'mother_job' => ($request['mother_job']) ? $request['mother_job'] : $parent['mother_job'],
            'mother_nationalitie_id' => ($request['mother_nationalitie_id']) ? $request['mother_nationalitie_id'] : $parent['mother_nationalitie_id'],
            'mother_blood_id' => ($request['mother_blood_id']) ? $request['mother_blood_id'] : $parent['mother_blood_id'],
            'mother_religion_id' => ($request['mother_religion_id']) ? $request['mother_religion_id'] : $parent['mother_religion_id'],
        ]);
        return response()->json(
            [
                'data' => $parent,
                'message' => 'updated successfuly'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TheParent $parent)
    {
        $parent->delete();
        return response()->json(['message' => 'parents deleted successfully']);
    }

}

