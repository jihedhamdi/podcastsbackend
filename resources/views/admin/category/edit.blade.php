@extends('admin.layouts.app')

@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
			Modifier une Catégorie
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Accueil</a></li>
	      <li><a href="{{ route('category.index') }}">Liste des Catégories</a></li>
	      <li class="active">Modifier une Catégorie</li>
	    </ol>
	  </section>

	  <!-- Main content -->
	  <section class="content">
	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">Catégorie</h3>
	          </div>
	    		@include('includes.messages')      
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('category.update',$category->id) }}" method="post" enctype="multipart/form-data">
	          {{ csrf_field() }}
	          {{ method_field('PUT') }}
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-6">
	              <div class="form-group">
	                <label for="name">Titre</label>
	                <input type="text" class="form-control" id="name" name="name" placeholder="Titre" value="{{ $category->name }}">
	              </div>

	              <div class="form-group">
	                <label for="slug">Slug</label>
	                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ $category->slug }}">
	              </div>
                  <div class="form-group">
	                <label for="slug">Description</label>
	                <input type="text" class="form-control" id="description" name="description" placeholder="Description"  value="{{ $category->description }}">
	              </div>

				  <div class="form-group">
	                <label for="slug">Couleur</label>
	                <input type="color" class="form-control" id="color" name="color" placeholder="Couleur" style="width: 45px;" value="{{ $category->color }}">
	              </div>
				  <div class="form-group">
                    <label for="image">Image (1520 * 475)</label>
                    <input type="file" name="image" id="image" value="{{ $category->image}}">
                  </div>
			  @if( $category->image)
                    <img id="preview-image-before-upload" src="{{asset('storage/category'.$category->image.'.webp')}}" width="300px" height="300px"/>
                  @else
                  <img id="preview-image-before-upload" src=""   style="max-height: 300px;width: 300px;display: none;" />
                  @endif
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
	 
	   
	   $('#image').change(function(){
				
		let reader = new FileReader();
	 
		reader.onload = (e) => { 
	 
		  $('#preview-image-before-upload').attr('src', e.target.result); 
		  $('#preview-image-before-upload').css('display', "block");
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