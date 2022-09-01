@extends('admin.layouts.app')

@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
			Ajouter une Authorisation
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Accueil</a></li>
	      <li><a href="{{ route('permission.index') }}">Liste des Authorisation</a></li>
	      <li class="active">Ajouter une Authorisation</li>
	    </ol>
	  </section>

	  <!-- Main content -->
	  <section class="content">
	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Authorisation</h3>
	          </div>

	          @include('includes.messages')
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('permission.store') }}" method="post">
	          {{ csrf_field() }}
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-6">
	              <div class="form-group">
	                <label for="name">Authorisation Titre</label>
	                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Titre">
	              </div>

	              <div class="form-group">
	              	<label for="for">Authorisation for</label>
	              	<select name="for" id="for" class="form-control">
	              		<option selected disable>Sélectionnez Autorisation pour</option>
	              		<option value="user">utilisateur</option>
	              		<option value="post">Podcast</option>
	              		<option value="other">Autre</option>
	              	</select>
	              </div>

	            <div class="form-group">
	              <button type="submit" class="btn btn-primary">Enregistrer</button>
	              <a href='{{ route('permission.index') }}' class="btn btn-warning">Retour</a>
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