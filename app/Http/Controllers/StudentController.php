<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $all_data = Student::latest() -> get();
        return view('student.index', compact('all_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //form validation
        // $this -> validate($request, [
        //     'name'          => 'required',
        //     'uname'          => 'required',
        //     'email'          => 'required',
        //     'cell'          => 'required',
        // ]);

        //file upload by Database
        if ( $request -> hasFile('photo') ) {
            $img = $request -> file('photo');
            $unique_file = md5(time().rand()) .'.'. $img -> getClientOriginalExtension();
            $img -> move(public_path('assets/media/student/'), $unique_file);
        }else{
            $unique_file = '';
        }

        //Database data Send
        Student::create([
            'name' => $request -> name,
            'uname' => $request -> uname,
            'email' => $request -> email,
            'cell' => $request -> cell,
            'photo' => $unique_file,
        ]);

        //redirect to home page
        // return redirect() -> route('student');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show_data = Student::find($id);

        ?>
        
            <img style="height: 250px; width: 250px; border-radius: 50%; border: 7px solid black; margin-left: 100px; object-fit: cover;" src="assets/media/Student/<?php echo $show_data -> photo ?>" alt="">
            <h2 style="font-weight: 600; text-align: center; font-family: cursive;"><?php echo $show_data -> name ?></h2>
            <table class="table table-striped">
                <tr>
                    <td>Name</td>
                    <td><?php echo $show_data -> name ?></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><?php echo $show_data -> uname ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $show_data -> email ?></td>
                </tr>
                <tr>
                    <td>Cell</td>
                    <td><?php echo $show_data -> cell ?></td>
                </tr>
            </table>

        <?php
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit_data = Student::find($id);
        return [
           'name' => $edit_data -> name,
           'id' => $edit_data -> id,
           'uname' => $edit_data -> uname,
           'email' => $edit_data -> email,
           'cell' => $edit_data -> cell,
           'photo' => $edit_data -> photo,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {   
        //get id
        $id = $request -> id;

        //file upload
        if ( $request -> hasFile('new_photo') ) {
            $img = $request -> file('new_photo');
            $unique_file = md5(time().rand()) .'.'. $img -> getClientOriginalExtension();
            $img -> move(public_path('assets/media/student/'), $unique_file);
            unlink('assets/media/student/'. $request -> old_photo );
        }else{
            $unique_file = $request -> old_photo;
        }
        
        //update data by database
        $all_data = Student::find($id);
        $all_data -> name = $request -> name;
        $all_data -> uname = $request -> uname;
        $all_data -> cell = $request -> cell;
        $all_data -> email = $request -> email;
        $all_data -> photo = $unique_file;
        $all_data -> update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_data = Student::find($id);
        $delete_data -> delete();

        return redirect() -> back() -> with('success', 'Student Deleted Successfull');
    }
}
