@extends('admin.layouts.app')

@section('main-content')
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	  <!-- Content Header (Page header) -->
	  <section class="content-header">
	    <h1>
			Modifier une page informative
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Accueil</a></li>
	      <li><a href="{{ route('gestion-page-informative.index') }}">Liste des pages informatives</a></li>
	      <li class="active">Modifier une page informative</li>
	    </ol>
	  </section>

	  <!-- Main content -->
	  <section class="content">
	    <div class="row">
	      <div class="col-md-12">
	        <!-- general form elements -->
	        <div class="box box-primary">
	          <div class="box-header with-border">
	            <h3 class="box-title">page informative</h3>
	          </div>
	    		@include('includes.messages')      
	          <!-- /.box-header -->
	          <!-- form start -->
	          <form role="form" action="{{ route('gestion-page-informative.update',$pageinformative->id) }}" method="post"  >
	          {{ csrf_field() }}
	          {{ method_field('PUT') }}
	            <div class="box-body">
	            <div class="col-lg-offset-3 col-lg-6">
	              <div class="form-group">
	                <label for="titre">Titre</label>
	                <input type="text" class="form-control" id="titre" name="titre" placeholder="titre" value="{{ $pageinformative->titre }}">
	              </div>

	              <div class="form-group">
	                <label for="slug">Slug</label>
	                <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ $pageinformative->slug }}">
	              </div>
                  <div class="form-group">
	                <label for="contenu">Contenu</label>
                    <textarea name="contenu" id="editor1"  class="form-control" cols="30"  rows="10"  value="{{ $pageinformative->contenu }}" placeholder="Contenu"></textarea>
	              </div>

				
	            <div class="form-group">
	              <button type="submit" class="btn btn-primary">Enregistrer</button>
	              <a href="{{ route('gestion-page-informative.index') }}" class="btn btn-warning">Retour</a>
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