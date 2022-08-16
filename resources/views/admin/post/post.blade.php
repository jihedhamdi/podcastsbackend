@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/select2/select2.min.css') }}">
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Ajouter un Podcast
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Accueil</a></li>
      <li><a href="{{ route('post.index') }}">Liste des Podcasts</a></li>
      <li class="active">Ajouter un Podcast</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Podcasts</h3>
          </div>
          @include('includes.messages')
          <!-- /.box-header -->
          <!-- form start -->
          <form role="form" action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="title">Podcast Titre</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Titre">
                </div>

                <div class="form-group">
                  <label for="subtitle">Podcast Sous-Titre</label>
                  <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Sous-Titre">
                </div>

                <div class="form-group">
                  <label for="slug">Podcast Slug</label>
                  <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug">
                </div>
                
              </div>
              <div class="col-lg-6">
                            <br>
                              <div class="form-group">
                                <div class="pull-right">
                                  <label for="image">Image</label>
                                  <input type="file" name="image" id="image">
                                </div>
                                <div class="checkbox pull-left">
                                  <label>
                                    <input type="checkbox" name="status" value="1"> Enligne
                                  </label>
                                </div>
                              </div>
                              <br>
                              <div class="form-group" style="margin-top:18px;">
                                <label>Sélectionner les Mots clés</label>
                                <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Sélectionner les Mots clés" style="width: 100%;" tabindex="-1" aria-hidden="true" name="tags[]">
                                @foreach ($tags as $tag)
                                  <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                @endforeach
                                </select>
                              </div>
                              <div class="form-group" style="margin-top:18px;">
                                <label>Sélectionner les Auteurs</label>
                                <select class="form-control select2 select2-hidden-accessible"  data-placeholder="Sélectionner les Auteurs" style="width: 100%;" tabindex="-1" aria-hidden="true" name="authors">
                                  @foreach ($authors as $author)
                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                              <div class="form-group" style="margin-top:18px;">
                                <label>Sélectionner les Categories</label>
                                <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Sélectionner les Categories" style="width: 100%;" tabindex="-1" aria-hidden="true" name="categories[]">
                                  @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                  @endforeach
                                </select>
                              </div>
                              
                            </div>
            </div>
            <!-- /.box-body -->
            
            <div class="box">
             <div class="box-header">
               <h3 class="box-title">Contenu
               </h3>
               <!-- tools box -->
               <div class="pull-right box-tools">
                 <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                   <i class="fa fa-minus"></i></button>
                 </div>
                 <!-- /. tools -->
               </div>
               <!-- /.box-header -->
               <div class="box-body pad">
                 <textarea name="body" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="editor1"></textarea>
               </div>
             </div>

             <div class="box-footer">
              <input type="submit" class="btn btn-primary" Value="Enregistrer">
              <a href="{{ route('post.index') }}" class="btn btn-warning">Retour</a>
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
<script src="{{ asset('admin/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{  asset('admin/ckeditor/ckeditor.js') }}"></script>
<script>
    $(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('editor1');
    });
</script>
<script>
  $(document).ready(function() {
    $(".select2").select2();
  });
</script>
@endsection