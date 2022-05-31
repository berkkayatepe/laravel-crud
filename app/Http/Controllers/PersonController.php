<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\PersonAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    public function view()
    {
        $persons = Person::paginate(4);
        return view('person.list')->with("persons", $persons);
    }

    public function create()
    {
        return view('person.create_edit');
    }

    public function edit($id)
    {
        $id = intval(decrypt($id));
        $detail = Person::where("id", $id)->first();
        return view('person.create_edit')->with("detail",$detail);
    }

    public function post_operation(Request $request)
    {
        $get = json_decode(json_encode($request->input()), false);

        $id = isset($get->person_id) ? intval(decrypt($get->person_id)) : null;


        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|',
            'birthday' => 'required|date|',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $model = $id != null ? Person::where('id', $id)->first() : new Person();
        $model->name = $get->name;
        $model->birthday = $get->birthday ?? null;
        $model->gender = $get->gender ?? '';
        if ($model->save()) {
            $model_relation = $id != null ? PersonAddress::where('person_id', $id)->first() : new PersonAddress();
            $model_relation->person_id = $model->id;
            $model_relation->address = $get->address ?? '';
            $model_relation->post_code = $get->post_code ?? '';
            $model_relation->city_name = $get->city_name ?? '';
            $model_relation->country_name = $get->country_name ?? '';
            $model_relation->save();
            if ($model_relation) $success = "Successful";
            else $error = "Error";

        } else $error = "Error";

        return $id == null ? redirect(route('person.list')) : redirect(route('person.edit', ['id' => $get->person_id]))->with((isset($success) ? 'success' : 'error'), $success ?? $error);

    }

    public function delete($id)
    {
        $id = intval(decrypt($id));
        if ($id) {
            Person::where("id", $id)->delete();
            $success = "Successful";
        } else {
            $error = "Error";
        }
        return \redirect()->back()->with((isset($success) ? 'success' : 'error'), $success ?? $error);
    }

}
