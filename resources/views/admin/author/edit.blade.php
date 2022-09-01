@extends('admin.layouts.app')

@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
			Modifier un Auteur
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Accueil</a></li>
	      <li><a href="{{ route('authors.index') }}">Liste des Auteurs</a></li>
	      <li class="active">Modifier un Auteur</li>
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
	          <form role="form" action="{{ route('authors.update',$author->id) }}" method="post" enctype="multipart/form-data">
	          {{ csrf_field() }}
	          {{ method_field('PUT') }}
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-6">

					<div class="form-group">
						<label for="name"> nom  </label>
						<input type="text" class="form-control" id="last_name" name="last_name" value="{{ $author->last_name }}" placeholder="nom">
					  </div>
	
					  <div class="form-group">
						<label for="name"> prénom  </label>
						<input type="text" class="form-control" id="first_name" name="first_name" value="{{ $author->first_name }}" placeholder="pseudo">
					  </div>
					  
	              <div class="form-group">
	                <label for="name">pseudo</label>
	                <input type="text" class="form-control" id="name" name="name" placeholder="pseudo " value="{{ $author->name }}">
	              </div>

				  <div class="form-group">
	                <label for="name"> email  </label>
	                <input type="text" class="form-control" id="email" name="email" value="{{ $author->email }}" placeholder="email">
	              </div>

	              <div class="form-group">
	                <label for="slug"> Slug</label>
	                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ $author->slug }}">
	              </div>
                  <div class="form-group">
	                <label for="slug"> description</label>
	                <input type="text" class="form-control" id="description" name="description" placeholder="description"  value="{{ $author->description }}">
	              </div>

				  <div class="form-group">
	                <label for="name"> nom du métier </label>
	                <input type="text" class="form-control" id="job_name" name="job_name" value="{{ $author->job_name }}" placeholder="nom du métier">
	              </div>

				  <div class="form-group">
					<label for="company-content">Sex</label>
					<select name="gender" id="gender" class="form-control">
					<option value="Homme"  {{ $author->gender == "Homme" ? 'selected' : '' }}>Homme</option>
					<option value="Femme" {{ $author->gender == "Femme" ? 'selected' : '' }}>Femme</option>
					</select>
					</div>

				  <div class="form-group">
	                <label for="slug"> Couleur</label>
	                <input type="color" class="form-control" id="color" name="color" placeholder="Couleur" style="width: 45px;" value="{{ $author->color }}">
	              </div>
					@if( $author->image)
						<img id="preview-image-before-upload" src="{{asset('storage/'.'/author/'.$author->image)}}" width="300px" height="300px" />
						@else
						<img id="preview-image-before-upload" src=""  style="max-height: 300px;width: 300px;display: none;"/>
						@endif
				  <div class="form-group">
                    <label for="image"> image</label>
                    <input type="file" name="image" id="image" value="">
                  </div>
				  @if( $author->bgimage)
						<img id="preview_bgimage" src="{{asset('storage/'.'/author/bg/'.$author->bgimage)}}" width="300px" height="300px" />
						@else
						<img id="preview_bgimage" src=""  style="max-height: 300px;width: 300px;display: none;"/>
						@endif
				  <div class="form-group">
                    <label for="bgimage">background image</label>
                    <input type="file" name="bgimage" id="bgimage" value="">
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
@section('footerSection')
<script type="text/javascript">
      
	$(document).ready(function (e) {
	 
	   
	   $('#image').change(function(){
				
		let reader = new FileReader();
	 
		reader.onload = (e) => { 
	 
		  $('#preview-image-before-upload').attr('src', e.target.result); 
		  $('#preview-image-before-upload').css('display', "block");
		}
	 
		reader.readAsDataURL(this.files[0]); 
	   
	   });

	   $('#bgimage').change(function(){
				
				let reader = new FileReader();
			 
				reader.onload = (e) => { 
			 
				  $('#preview_bgimage').attr('src', e.target.result); 
				  $('#preview_bgimage').css('display', "block");
				}
			 
				reader.readAsDataURL(this.files[0]); 
			   
			   });
	   
	});
	 
	</script>
@endsection