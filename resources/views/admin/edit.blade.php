
@extends('layouts.admin')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <div class="row">

          	<div class="col-lg-6 border-bottom-primary rotate-n-15">

	          <div class="card shadow mb-6">

	            <div class="card-header py-3">
	              <h6 class="m-0 font-weight-bold text-primary">Edit form</h6>
	            </div>
	            <div class="card-body">
		          		<!-- Edit form -->
			          	<form action="{{route('userUpdate', $user->id)}}" method="post">
			          	@csrf
			          	@method('get')
			          		<label>Avatar</label><br>
					        <input type="file" name="avatar" value="{{$user->avatar}}"><br>
			          		<label>Name</label><br>
					        <input type="text" name="name" value="{{$user->name}}"><br>
			          		<label>Last name</label><br>
					        <input type="text" name="lastname" value="{{$user->lastname}}"><br>
			          		<label>Biography</label><br>
					        <input type="text" name="biography" value="{{$user->biography}}"><br>
			          		<label>Age</label><br>
					        <input type="text" name="age" value="{{$user->age}}"><br>
			          		<label>Country</label><br>
					        <input type="text" name="country" value="{{$user->country}}"><br><br>

					        <button type="submit" class="btn btn-light">Edit profile</button>
				    	</form>
				      </div>
				  </div>
			  </div>

	        </div>

        </div>
        <!-- /.container-fluid -->

@endsection