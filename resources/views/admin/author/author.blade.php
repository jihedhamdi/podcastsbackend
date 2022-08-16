@extends('admin.layouts.app')

@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
			Ajouter un Auteur
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Accueil</a></li>
	      <li><a href="{{ route('authors.index') }}">Liste des Auteurs</a></li>
	      <li class="active">Ajouter un Auteur</li>
	    </ol>
	  </section>

	  <!-- Main content -->
	  <section class="content">
	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->
	        <div class="box box-primary">

	    		@include('includes.messages')      
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('authors.store') }}" method="post" enctype="multipart/form-data">
	          {{ csrf_field() }}
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-6">
	              <div class="form-group">
	                <label for="name">Auteur Nom et prénom </label>
	                <input type="text" class="form-control" id="name" name="name" placeholder="nom et prénom">
	              </div>

	              <div class="form-group">
	                <label for="slug">Auteur Slug</label>
	                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug">
	              </div>

				  <div class="form-group">
	                <label for="slug">Auteur description</label>
	                <input type="text" class="form-control" id="description" name="description" placeholder="Description">
	              </div>

				  <div class="form-group">
	                <label for="slug">Auteur Couleur</label>
	                <input type="color" class="form-control" id="color" name="color" placeholder="Couleur" style="width: 45px;">
	              </div>
				  <div class="form-group">
                    <label for="image">Auteur image</label>
					<input type="file" name="image" id="image">
                  </div>

	            <div class="form-group">
	              <button type="submit" class="btn btn-primary">Enregistrer</button>
	              <a href="{{ route('authors.index') }}" class="btn btn-warning">Retour</a>
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