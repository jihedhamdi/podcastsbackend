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
						<label for="name">Nom  </label>
						<input type="text" class="form-control" id="last_name" name="last_name" value="{{ $author->last_name }}" placeholder="nom">
					  </div>
	
					  <div class="form-group">
						<label for="name">Prénom  </label>
						<input type="text" class="form-control" id="first_name" name="first_name" value="{{ $author->first_name }}" placeholder="pseudo">
					  </div>
					  
	              <div class="form-group">
	                <label for="name">Pseudo</label>
	                <input type="text" class="form-control" id="name" name="name" placeholder="pseudo " value="{{ $author->name }}">
	              </div>

				  <div class="form-group">
	                <label for="name">Email  </label>
	                <input type="text" class="form-control" id="email" name="email" value="{{ $author->email }}" placeholder="email">
	              </div>

	              <div class="form-group">
	                <label for="slug">Slug</label>
	                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ $author->slug }}">
	              </div>

				  <div class="form-group">
					<label for="slug">Description</label>
					<textarea name="description"
						style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
						id="editor1">{{ $author->description }}</textarea>
				</div>

				  <div class="form-group">
	                <label for="name">Nom du métier </label>
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
	                <label for="slug">Couleur</label>
	                <input type="color" class="form-control" id="color" name="color" placeholder="Couleur" style="width: 45px;" value="{{ $author->color }}">
	              </div>
				  <div class="form-group">
	                <label for="name"> Lien Facebook </label>
	                <input type="text" class="form-control" id="link_facebook" name="link_facebook" value="{{ $author->link_facebook }}" placeholder="lien facebook">
	              </div>
				  
				  <div class="form-group">
	                <label for="name"> Lien Twitter </label>
	                <input type="text" class="form-control" id="link_twitter" name="link_twitter" value="{{  $author->link_twitter }}" placeholder="lien Twitter">
	              </div>
				  <div class="form-group">
	                <label for="name"> Lien Youtube </label>
	                <input type="text" class="form-control" id="link_youtube" name="link_youtube" value="{{  $author->link_youtube }}" placeholder="lien Youtube">
	              </div>
				  
				  <div class="form-group">
	                <label for="name"> Lien Instagram </label>
	                <input type="text" class="form-control" id="link_Instagram" name="link_Instagram" value="{{  $author->link_Instagram }}" placeholder="lien Instagram">
	              </div>
					@if( $author->image)
						<img id="preview-image-before-upload" src="{{asset('storage/'.'/author/'.$author->image)}}" width="300px" height="300px" />
						@else
						<img id="preview-image-before-upload" src=""  style="max-height: 300px;width: 300px;display: none;"/>
						@endif
				  <div class="form-group">
                    <label for="image">Image (144 * 144)</label>
                    <input type="file" name="image" id="image" value="">
                  </div>
				  @if( $author->bgimage)
						<img id="preview_bgimage" src="{{asset('storage/'.'/author/bg/'.$author->bgimage)}}" width="300px" height="300px" />
						@else
						<img id="preview_bgimage" src=""  style="max-height: 300px;width: 300px;display: none;"/>
						@endif
				  <div class="form-group">
                    <label for="bgimage">Background image (1520 * 570)</label>
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
<script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
<script>
	$(function() {
		// Replace the <textarea id="editor1"> with a CKEditor
		// instance, using default configuration.
		CKEDITOR.replace('editor1');
	});
</script>
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

			   $('#name').keyup(function(e) {
                e.preventDefault();
        var title = $(this).val(); 
 
         
        $.ajax({

            type: "POST",
            dataType: "json",
            url: '/admin/post_Slug',
            data: {'title': title,'_token': "{{ csrf_token() }}"},
            success: function(data){
                console.log(data.slug)
                $('#slug').val(data.slug);
            }
        });
    })
	   
	});
	 
	</script>
@endsection