@extends('admin.layouts.app')

@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
			Ajouter un Catégorie
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Accueil</a></li>
	      <li><a href="{{ route('category.index') }}">Liste des Catégories</a></li>
	      <li class="active">Ajouter une Catégorie</li>
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
	          <form role="form" action="{{ route('category.store') }}" method="post" enctype="multipart/form-data">
	          {{ csrf_field() }}
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-6">
	              <div class="form-group">
	                <label for="name">Titre</label>
	                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Titre">
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
	                <label for="slug">Couleur</label>
	                <input type="color" class="form-control" id="color" name="color" value="{{ old('color') }}" placeholder="Couleur" style="width: 45px;">
	              </div>
				  <div class="form-group">
                    <label for="image">Image (1520 * 475)</label>
					<input type="file" name="image" id="image" value="{{ old('image') }}">
                  </div>
				  <img id="preview-image-before-upload" src=""
				  style="max-height: 250px;width: 250px;display: none;" />
	            <div class="form-group">
	              <button type="submit" class="btn btn-primary">Enregistrer</button>
	              <a href="{{ route('category.index') }}" class="btn btn-warning">Retour</a>
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
	
	   $('#image').change(function(){
				
		let reader = new FileReader();
	 
		reader.onload = (e) => { 
	 
		  $('#preview-image-before-upload').attr('src', e.target.result); 
		  $('#preview-image-before-upload').css('display', "block");
		}
	 
		reader.readAsDataURL(this.files[0]); 
	   
	   });
	   
	});
	 
	</script>
@endsection