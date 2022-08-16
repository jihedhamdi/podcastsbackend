@extends('admin.layouts.app')

@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
			Ajouter un Rôle
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Accueil</a></li>
	      <li><a href="{{ route('role.index') }}">Liste des Rôles</a></li>
	      <li class="active">Ajouter un Rôle</li>
	    </ol>
	  </section>

	  <!-- Main content -->
	  <section class="content">
	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Rôles</h3>
	          </div>

	          @include('includes.messages')
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('role.store') }}" method="post">
	          {{ csrf_field() }}
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-6">
	              <div class="form-group">
	                <label for="name">Rôle Titre</label>
	                <input type="text" class="form-control" id="name" name="name" placeholder="Titre">
	              </div>
				
				<div class="row">
	              <div class="col-lg-4">
	              	<label for="name">Podcasts Authorisation</label>
	              	@foreach ($permissions as $permission)
	              		@if ($permission->for == 'post')
			              	<div class="checkbox">
			              		<label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
			              	</div>
	              		@endif
	              	@endforeach
	              </div>
	              <div class="col-lg-4">
	              	<label for="name">utilisateur Authorisation</label>
  	              	@foreach ($permissions as $permission)
  	              		@if ($permission->for == 'user')
  			              	<div class="checkbox">
  			              		<label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
  			              	</div>
  	              		@endif
  	              	@endforeach
	              </div>

	              <div class="col-lg-4">
	              	<label for="name">Other Authorisation</label>
  	              	@foreach ($permissions as $permission)
  	              		@if ($permission->for == 'other')
  			              	<div class="checkbox">
  			              		<label><input type="checkbox" name="permission[]" value="{{ $permission->id }}">{{ $permission->name }}</label>
  			              	</div>
  	              		@endif
  	              	@endforeach
	              </div>
	            </div>
					
	            <div class="form-group">
	              <button type="submit" class="btn btn-primary">Enregistrer</button>
	              <a href='{{ route('role.index') }}' class="btn btn-warning">Retour</a>
	            </div>
	            	
	            </div>
					
				</div>

	          </form>
	        </div>
	        <!-- /.box -->

	        
	      </div>
	      <!-- /.col-->
	    </div>
	    <!-- ./row -->
	  </section>
	  <!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
@endsection