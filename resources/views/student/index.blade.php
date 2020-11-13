<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Development Area</title>
	<!-- ALL CSS FILES  -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/datatables.min.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/responsive.css">
</head>
<body>

	<div class="wrap-table">
		<a data-toggle="modal" class="btn btn-primary" href="#student-add_nodal">Add New Student</a>
		<div class="card shadow-lg">
			<div class="card-body">
				<h2>All Data</h2>
                <div class="mess"></div>
                @include('validation')
				<table id="data_table" class="table table-striped">
					<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Cell</th>
							<th>Photo</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach( $all_data as $data )
						<tr> 
							<td>{{ $loop -> index + 1 }}</td>
							<td>{{ $data -> name }}</td>
							<td>{{ $data -> email }}</td>
							<td>{{ $data -> cell }}</td>
							<td><img src="assets/media/Student/{{ $data -> photo }}" alt=""></td>
							<td>
								<a id="show_btn" show_id="{{ $data -> id }}" class="btn btn-sm btn-info" data-toggle="modal" href="#show_student_modal">View</a>
								<a id="edit_btn" edit_id="{{ $data -> id }}" class="btn btn-sm btn-warning" data-toggle="modal" href="#edit_student_modal">Edit</a>
								<form style="display: inline;" action="{{ route('student.destroy', $data -> id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button id="delete_btn" class="btn btn-sm btn-danger">delete</button>
                                </form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
    
    {{-- student_add_modal --}}
	<div id="student-add_nodal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add new Student</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="add_student_form" action="{{ route('studnet.add') }}"  method="POST" enctype="multipart/form-data">
                    	@csrf

                        <div class="form-group">
                            <input name="name" class="form-control" type="text" placeholder="Enter Your Name">
                        </div>

                        <div class="form-group">
                            <input name="uname" class="form-control" type="text" placeholder="Enter Your Username">
                        </div>

                        <div class="form-group">
                            <input name="email" class="form-control" type="text" placeholder="Enter Your Email">
                        </div>

                        <div class="form-group">
                            <input name="cell" class="form-control" type="text" placeholder="Enter Your Cell">
                        </div>

                        <div class="form-group">
                            <img style="display: inline-block; width: 200px; height: 200px; border: 5px solid black; padding: 5px; margin-bottom: 5px;" id="student_photo" src="" alt="">
                            <input id="student_file" name="photo" class="form-control" type="file">
                        </div>

                        <div class="form-group">
                            <input class="btn btn-block btn-info" type="submit" value="Add New Student">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    
    {{-- student_update_modal --}}
    <div id="edit_student_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Student</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="update_student_form" action="{{ route('studnet.update') }}"  method="POST" enctype="multipart/form-data">
                    	@csrf

                        <div class="form-group">
                            <input name="name" class="form-control" type="text" placeholder="Enter Your Name">
                            <input name="id" class="form-control" type="hidden" placeholder="Enter Your Name">
                        </div>

                        <div class="form-group">
                            <input name="uname" class="form-control" type="text" placeholder="Enter Your Username">
                        </div>

                        <div class="form-group">
                            <input name="email" class="form-control" type="text" placeholder="Enter Your Email">
                        </div>

                        <div class="form-group">
                            <input name="cell" class="form-control" type="text" placeholder="Enter Your Cell">
                        </div>

                        <div class="form-group">
                        	 <img style="display: inline-block; width: 200px; height: 200px; border: 5px solid black; padding: 5px; margin-bottom: 5px;" id="student_photo" src="" alt="">
                        	 <input type="hidden" name="old_photo" class="form-control">
                            <input id="student_file" name="new_photo" class="form-control" type="file">
                        </div>

                        <div class="form-group">
                            <input class="btn btn-block btn-info" type="submit" value="Update Student">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- student_show_modal --}}
    <div id="show_student_modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Single Student</h4>
                    <button class="close" data-dismiss="modal">&times;</button>
                </div>
                <div id="show_data" class="modal-body">
                    
                </div>
            </div>
        </div>
    </div>

	<!-- JS FILES  -->
	<script src="assets/js/jquery-3.4.1.min.js"></script>
	<script src="assets/js/datatables.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/script.js"></script>
	{{-- <script>
		$('button#delete_btn').click(function(e){
             e.preventDefault();

             let confirm = alert('are you sure');

             if ( confirm == true )
             {
             	return true;
             }else{
             	return false;
             }

		});
	</script> --}}
</body>
</html>