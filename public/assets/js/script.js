(function($){
    $(document).ready(function(){

     //student_file change
     $('input#student_file').change(function(e){
         let file_url = URL.createObjectURL(e.target.files[0]);
         $('img#student_photo').attr('src', file_url);
     });
     
     //Data Table Show
     $('table#data_table').DataTable();

     //add_student_form
     $(document).on('submit','form#add_student_form', function(event){
          event.preventDefault();
          
          //value get
          let name = $('form#add_student_form input[name="name"]').val();
          let uname = $('form#add_student_form input[name="uname"]').val();
          let email = $('form#add_student_form input[name="email"]').val();
          let cell = $('form#add_student_form input[name="cell"]').val();

          //form validation
          if ( name == '' || email == '' || uname == '' || cell == '' ) 
          { 
          	$('#student-add_nodal').modal('hide');
          	$('.mess').html('<p class="alert alert-danger">All fileds are require! <button data-dismiss="alert" class="close">&times;</button></p>');
          }else if(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/.test(email) == false ){
          	$('#student-add_nodal').modal('hide');
            $('.mess').html('<p class="alert alert-warning">Invalid Email Formate! <button data-dismiss="alert" class="close">&times;</button></p>');
          }else{
	      	//Ajax Request By Database
	        $.ajax({
	          url : 'student-add',
	          method : "POST",
	          contentType : false,
	          processData : false,
	          data : new FormData(this),
	          success : function(data){
	          	 $('form#add_student_form')[0].reset();
                 $('#student-add_nodal').modal('hide');
	          	 $('.mess').html('<p class="alert alert-success">Student Added Successfull <button data-dismiss="alert" class="close">&times;</button></p>');
	          	 $('img#student_photo').attr('src', '');
	          }
	        });
          }


     });

     //show edit student
     $(document).on('click','#edit_btn', function(e){
         e.preventDefault();
         
         //get id
         let id = $(this).attr('edit_id');

         //Ajax requiest
         $.ajax({
         	url : 'student-edit/' + id,
         	dataType : 'json',
         	success : function(data){
         		$('form#update_student_form input[name="name"]').val(data.name);
         		$('form#update_student_form input[name="id"]').val(data.id);
         		$('form#update_student_form input[name="uname"]').val(data.uname);
         		$('form#update_student_form input[name="email"]').val(data.email);
         		$('form#update_student_form input[name="cell"]').val(data.cell);
         		$('form#update_student_form input[name="old_photo"]').val(data.photo);
         		$('form#update_student_form img').attr('src', 'assets/media/Student/' + data.photo);
         	}
         });

     });

     //update_student_form method
     $(document).on('submit', 'form#update_student_form', function(e){
           e.preventDefault();
           
           //get value
           let name = $('form#update_student_form input[name="name"]').val();
           let id = $('form#update_student_form input[name="id"]').val();
           let uname = $('form#update_student_form input[name="uname"]').val();
           let email = $('form#update_student_form input[name="email"]').val();
           let cell = $('form#update_student_form input[name="cell"]').val();
           
           //ajax requiest
           $.ajax({
           	  url : 'student-update',
           	  method : "POST",
           	  data : new FormData(this),
           	  contentType : false,
           	  processData : false,
           	  success : function(data){
           	  	 $('.mess').html('<p class="alert alert-success">Student Updated Successfull <button data-dismiss="alert" class="close">&times;</button></p>');
           	  	 $('#edit_student_modal').modal('hide');
           	  }
           });

     });

     //Show Single Student
     $(document).on('click','a#show_btn', function(e){
        e.preventDefault();

        //get id
        let id = $(this).attr('show_id');

        //Ajax requiest
        $.ajax({
        	url : 'student-show/' + id,
        	success : function(data){
               $('#show_data').html(data);
        	}
        });

     });

   });
})(jQuery)