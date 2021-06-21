<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use DB;

class StudentController extends Controller
{
    public function getProfessors(Request $request) {

        $professors = Professor::where([]);

        if (!empty($request['firstName'])) {
            $criteria = strtolower($request['firstName']);
            $professors->whereRaw("LOWER(firstName) LIKE '%$criteria%'");
        }

        if (!empty($request['lastName'])) {
            $criteria = strtolower($request['lastName']);
            $professors->whereRaw("LOWER(lastName) LIKE '%$criteria%'");
        }

        if (!empty($request['city'])) {
            $criteria = strtolower($request['city']);
            $professors->whereRaw("LOWER(city) LIKE '%$criteria%'");
        }

        if (!empty($request['address'])) {
            $criteria = strtolower($request['address']);
            $professors->whereRaw("LOWER(address) LIKE '%$criteria%'");
        }

        if (!empty($request['salary'])) {
            $students->where('salary', $request->get('salary'));
        }

        
        $professors = $professors->paginate(3); 

        return view('professorstable', [
            'professors' => $professors,
            'firstName' => $request['firstName'],
            'lastName' => $request['lastName'],
            'city' => $request['city'],
            'address' => $request['address'],
            'salary' => $request['salary']
        ]);
    }

    public function showProfessorAdd() {
        return view('professoradd');
    }

    public function showProfessorAddAngular() {
        return view('professoraddangular', [
            'pagetitle' => 'New Professor'
        ]);
    }

    public function postProfessor(Request $request) {
        Professor::create([
            'firstName' => $request->input('firstName'),
            'lastName' => $request->input('lastName'),
            'city' => $request->input('city'),
            'address' => $request->input('address'),
            'salary' => $request->input('salary')
        ]);
        return redirect('/professors');
    }

    public function getProfessor($id) {
        $professor = Professor::where('id', $id)->firstOrFail();
        return view('professoredit', [
            'professor' => $professor
        ]);
    }

    public function putProfessor(Request $request) {
        $professor = Professor::find($request->get('id'));
        $professor->firstName = $request->get('firstName');
        $professor->lastName = $request->get('lastName');
        $professor->city = $request->get('city');
        $professor->address = $request->get('address');
        $professor->salary = $request->get('salary');
        $professor->save();
        return redirect('/professors');
    }
}

