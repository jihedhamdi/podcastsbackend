@extends('admin.layouts.app')

@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
			Modifier un Mot clé
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Accueil</a></li>
	      <li><a href="{{ route('tag.index') }}">Liste des Mots clés</a></li>
	      <li class="active">Modifier un Mot clé</li>
	    </ol>
	  </section>

	  <!-- Main content -->
	  <section class="content">
	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Mot clé</h3>
	          </div>

	          @include('includes.messages')
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('tag.update',$tag->id) }}" method="post">
	          {{ csrf_field() }}
	          {{ method_field('PUT') }}
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-6">
	              <div class="form-group">
	                <label for="name">Titre</label>
	                <input type="text" class="form-control" id="name" name="name" placeholder="Titre" value="{{ $tag->name }}">
	              </div>

	              <div class="form-group">
	                <label for="slug">Slug</label>
	                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ $tag->slug }}"> 
	              </div>

	            <div class="form-group">
	              <button type="submit" class="btn btn-primary">Enregistrer</button>
	              <a href='{{ route('tag.index') }}' class="btn btn-warning">Retour</a>
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