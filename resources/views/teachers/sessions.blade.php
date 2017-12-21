 @include('layouts/header')
 <link rel="stylesheet" href="{{URL::to('plugins/datatables/dataTables.bootstrap.css')}}">

  <!-- Left side column. contains the logo and sidebar -->
@include('layouts/teacher_nav')
<div class="content-wrapper">
    <section class="content">

      <div class="row">
      	<div class="col-md-12">
        	@if($c_id=='false')
        		<a class="btn btn-primary" href="create"><i class="fa fa-plus"></i> Create a session</a>
        	@else
        		<a class="btn btn-primary" href="../create"><i class="fa fa-plus"></i> Create a session</a>
        	@endif
        	<br>
        	<br>
      	</div>
        <!-- /.col (left) -->
        <div class="col-md-12">
	      <div class="box box-default">
	        <div class="box-header with-border">
	          <h3 class="box-title">Sessions</h3>
	          <div class="box-tools pull-right">
	            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	            <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button> -->
	          </div>
	        </div><!-- /.box-header -->
	        <div class="box-body">
	          <div class="form-inline" id="select-course">
	        	<div class="form-group">
	            	<label class="col-sm-12">Select course name</label>
	        	</div>
	          	<div class="form-group">
	            	<div class="col-sm-12 ">
		            	<select  id="course_name" class="form-control select2" style="width: 100%;" name="course" >
		            	<!-- onchange="if (this.value) if() window.location.href='sessions/'+this.value" -->
		              	@if($c_id!='false')
		              		<option value="">All course</option>
		                  	@foreach($courses as $cc)      
		                    	@if($c_id == $cc->c_id)
		                      	<option value="{{ $cc->c_id }}" selected >{{ $cc->title }}</option>
		                    	@else
		                      	<option value="{{ $cc->c_id }}">{{ $cc->title }}</option>
		                    	@endif
		                  	@endforeach

		              	@else
		              		<option selected  value="">All course</option>
		                	@foreach($courses as $cc)      
		                  	<option value="{{ $cc->c_id }}">{{ $cc->title }}</option>
		                	@endforeach
		              	@endif
		            	</select>
	            	</div>
	        	</div>
	            <button type="submit" id="change_course" class="btn btn-default">Select</button>
	           </div>
	          <!-- /.form-group -->
	          <table id="example2" class="table table-bordered table-hover">
	                    <thead>
	                      <tr>
	                      	@if($c_id=='false')
	                      	<th>Course category</th>
	                        <th>Course name</th>
	                        @endif
	                        <th>Session name</th>
	                        <th>Desciption</th>
	                        <th>Action</th>
	                      </tr>
	                    </thead>
	                    <tbody>
	                    @foreach($sessions as $c)

	                      <tr>
	                      	@if($c_id=='false')
	                      	<td>{{ $c->name }}</td>
	                        <td>{{ $c->c_title }}</td>
	                        @endif
	                        <td>{{ $c->title }}</td>
	                        <td>{{ $c->description }}</td>
	                        <td>
	                        	@if($c_id=='false')
	                        		<?php $str_url = ''; ?>
	                        	@else
	                        		<?php $str_url = '../'; ?>
	                        	@endif
	                        	<a href="{{$str_url}}edit/{{$c->s_id}}" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
	                        	<a href="{{$str_url}}delete/{{$c->s_id}}" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</a>
	                        	<a href="{{$str_url}}detail/{{$c->s_id}}" class="btn btn-primary"><i class="fa fa-book"></i> Detail</a>
	                        </td>
	                      </tr>
	                    @endforeach

	                    </tbody>
	                    <tfoot>
	                      <tr>
	                      	
	                      	@if($c_id=='false')
	                      	<th>Course category</th>
	                        <th>Course name</th>
	                        @endif
	                        <th>Session name</th>
	                        <th>Desciption</th>
	                        <th>Action</th>
	                      </tr>
	                    </tfoot>
	                  </table>
	          
	        </div><!-- /.box-body -->
	        <div class="box-footer">
	          
	        </div>
	      </div><!-- /.box -->

	  </div>
        
      </div><!-- /.row -->

    </section><!-- /.content -->
</div>
  @include('layouts/footer')

  <script src="{{URL::to('plugins/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{URL::to('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
  <script>
      $(function () {
        // $("#example1").DataTable();
        $('#example2').DataTable({
          // "paging": true,
          // "lengthChange": false,
          // "searching": false,
          // "ordering": true,
          // "info": true,
          // "autoWidth": false
        });
       //  $('#course_name').on('change', function () {
       //    var url = $(this).val(); // get selected value
       //    console.log(url);
       //    // if (url) { // require a URL
       //    //     window.location = 'sessions/'+url; // redirect
       //    // }
       //    return false;
      	// });
      		$('#course_name').change(function () {
      			var val = $(this).val();
	        	var url = window.location.pathname;
	        	var loc='';
	        	if (val=='/sessions') {
					 // loc = window.location+'/'+val; 
					 loc = window.location.hostname+':'+window.location.port+'/sessions/'+val; // redirect		
					 window.location =loc;
					 // console.log(loc);
	        	}else{
		        	if (val=='') {
		        		// console.log(window.location.hostname+':'+window.location.port+'/sessions');
		        		window.location = window.location.hostname+':'+window.location.port+'/sessions'; // redirect
		        	}else{
			        	loc = window.location.hostname+':'+window.location.port+'/sessions/'+val; // redirect
		        		// console.log(location);
		        		window.location = loc;
		        	}
	        		 // console.log(loc);
	        	}
	        	// console.log(window.location.href);
	        	return false;

      		});

      });
      		$('button#change_course').click( function () {
      			// e.preventDefault();
      			// console.log('LALALA');
      			var val = $('select#course_name').val();
	        	var url = window.location.pathname;
	        	var loc='';
	        	if (url=='/sessions/teacher') {
					 // loc = window.location+'/'+val;
					 if (val=='') { 
					 	// window.location = '../teacher'; // redirect		
					 }else{
					 	window.location = '/sessions/courses/'+val; // redirect		
					 }
					 // window.location =loc;
					 // console.log(loc);
	        	}else{
		        	if (val=='') {
		        		// console.log(window.location.hostname+':'+window.location.port+'/sessions');
		        		// window.location = window.location.hostname+':'+window.location.port+'/sessions'; // redirect
		        		window.location = '../teacher';
		        	}else{
			        	window.location  = '../courses/'+val; // redirect
		        		// console.log(location);
		        		// window.location = loc;
		        	}
	        		 // console.log(loc);
	        	}
	        	// return true;
	        	// window.location='sessions';
      		});

    </script>