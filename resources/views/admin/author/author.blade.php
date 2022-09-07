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
	                <label for="name">Nom  </label>
	                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="nom">
	              </div>

				  <div class="form-group">
	                <label for="name">Prénom  </label>
	                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="pseudo">
	              </div>

				  <div class="form-group">
	                <label for="name">Pseudo  </label>
	                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="pseudo">
	              </div>

				  <div class="form-group">
	                <label for="name">Email  </label>
	                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="email">
	              </div>

	              <div class="form-group">
	                <label for="slug">Slug</label>
	                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" placeholder="Slug">
	              </div>

				  <div class="form-group">
	                <label for="slug">Description</label>
	                <input type="text" class="form-control" id="description" name="description" value="{{ old('description') }}" placeholder="Description">
	              </div>

				  <div class="form-group">
	                <label for="name">Nom du métier </label>
	                <input type="text" class="form-control" id="job_name" name="job_name" value="{{ old('job_name') }}" placeholder="nom du métier">
	              </div>

				  <div class="form-group">
					<label for="company-content">Sex</label>
					<select name="gender" id="gender" class="form-control">
					<option value="Homme"  {{ old('gender') == "Homme" ? 'selected' : '' }}>Homme</option>
					<option value="Femme" {{ old('gender') == "Femme" ? 'selected' : '' }}>Femme</option>
					</select>
					</div>

				  <div class="form-group">
	                <label for="slug">Couleur</label>
	                <input type="color" class="form-control" id="color" name="color" value="{{ old('color') }}" placeholder="Couleur"  style="width: 45px;">
	              </div>
				  <div class="form-group">
                    <label for="image">Image</label>
					<input type="file" name="image" id="image" value="{{ old('image') }}">
                  </div>
				  <img id="preview-image-before-upload" src=""
                      alt="preview image"  style="max-height: 300px;width: 300px;display: none;">

					<div class="form-group">
					<label for="bgimage">Background Image</label>
					<input type="file" name="bgimage" id="bgimage" value="{{ old('bgimage') }}">
					</div>
					<img id="preview_bgimage" src=""
						alt="preview background image"  style="max-height: 300px;width: 300px;display: none;">

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