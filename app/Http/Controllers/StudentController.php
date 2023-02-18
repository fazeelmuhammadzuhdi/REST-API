<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentStoreRequest;
use App\Models\ClassRoom;
use App\Models\Extracurricular;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with(['class', 'extracurriculars'])->latest()->get();
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class = ClassRoom::all();
        $eksul = Extracurricular::all();
        return view('student.create', compact('class', 'eksul'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentStoreRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();
        // $eksul = $request->extracurricular_id;

        $student = Student::create($data);

        $student->extracurriculars()->attach($request->extracurricular_id);
        return to_route('students.index')->with('success', 'Data Berhasil Di Simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students = Student::findOrFail($id);
        $class = ClassRoom::all();
        // $study = Extracurricular::all();
        // $studies = $study->students;
        // dd($studies);
        // $eksul = Extracurricular::whereNotIn('id', [$studies->extracurricular_id])->get();
        $eksul = Extracurricular::all();


        return view('student.edit', compact('students', 'class', 'eksul'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        // dd($data);
        $item = Student::findOrFail($id);

        $item->update($data);
        $item->extracurriculars()->sync($request->extracurricular_id);
        $item->save();

        return redirect(route('students.index'))->with('success', 'Data Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Student::findOrFail($id)->delete();

        return back();
    }
}
