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
    Modifier un Podcast
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Accueil</a></li>
      <li><a href="{{ route('post.index') }}">Liste des Podcasts</a></li>
      <li class="active">Modifier un Podcast</li>
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
          <form role="form" action="{{ route('post.update',$post->id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <div class="box-body">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="title">Titre</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Titre" value="{{ $post->title }}">
                </div>

                <div class="form-group">
                  <label for="subtitle">Sous-Titre </label>
                  <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Sous Titre" value="{{ $post->subtitle }}">
                </div>

                <div class="form-group">
                  <label for="slug">Slug</label>
                  <input type="text" class="form-control" id="slug" name="slug" placeholder="Slug" value="{{ $post->slug }}">
                </div>

                <div class="form-group">
                  <label for="slug">mp3 url</label>
                  <input type="text" class="form-control" id="audio_link" name="audio_link"  value="{{ $post->audio_link }}" placeholder="mp3 url">
                </div>

                <div class="form-group">
                  <label class="control-label"><strong>Options</strong></label>
                  <div class="controls">
                      <div class="row-fluid">
                          <div class="span5">
                              <table border="0" width="500" style="display: flex;padding-left: 50px;">
                                  <tr>
                                      <td><label class="checkbox line">
                                              <input type="checkbox" name="animation" value="1"
                                              @if ($post->animation == 1)
                                              {{'checked'}}
                                            @endif><strong>Animation
                                                  à la une</strong>
                                          </label></td>
                                  </tr>
                                  <tr>
                                      <td><label class="checkbox line">
                                              <input type="checkbox" name="access" value="1"
                                              @if ($post->access == 1)
                                              {{'checked'}}
                                            @endif><strong>
                                                  Accées limité au abonnées </strong>
                                          </label></td>
                                  </tr>
                                  <tr>
                                      <td><label class="checkbox line">
                                              <input type="checkbox" name="visible" value="1"
                                              @if ($post->visible == 1)
                                              {{'checked'}}
                                            @endif><strong>
                                                  Contenu invisible</strong>
                                          </label></td>
                                  </tr>
                                  <tr>
                                      <td> <label class="checkbox line">
                                              <input type="checkbox" name="status" value="1"
                                              @if ($post->status == 1)
                                              {{'checked'}}
                                            @endif>
                                              <strong> Enligne </strong>
                                          </label></td>
                                      <td> </td>
                                  </tr>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
                
              </div>
             
              <div class="col-lg-6">
                <br>
                <div class="form-group" style="display: flex;">
                  <div class="pull-right">
                    <label for="image">Image (405 * 304)</label>
                    <input type="file" name="image" id="image">
                    @if( $post->image)
                    <img id="preview-image-before-upload" src="{{asset('storage/posts/thumbs/300_'.$post->image.'.webp')}}" width="300px" height="300px"/>
                  @else
                  <img id="preview-image-before-upload" src=""   style="max-height: 300px;width: 300px;display: none;" />
                  @endif
                  </div>
                </div>
                
                <br>
                <div class="form-group" style="margin-top:18px;">
                  <label>Sélectionner les Mots clés</label>
                  <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Sélectionner les Mots clés" style="width: 100%;" tabindex="-1" aria-hidden="true" name="tags[]">
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}"
                      @foreach ($post->tags as $postTag)
                        @if ($postTag->id == $tag->id)
                          selected
                        @endif
                      @endforeach
                    >{{ $tag->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group" style="margin-top:18px;">
                  <label>Sélectionner les Auteurs</label>
                  <select class="form-control select2 select2-hidden-accessible"  data-placeholder="Sélectionner les Auteurs" style="width: 100%;" tabindex="-1" aria-hidden="true" name="authors">
                    @foreach ($authors as $author)
                      <option value="{{ $author->id }}" @foreach ($post->authors as $postAuthor)
                        @if ($postAuthor->id == $author->id)
                          selected
                              @endif
                              @endforeach>{{ $author->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group" style="margin-top:18px;">
                  <label>Sélectionner les Categories</label>
                  <select class="form-control select2 select2-hidden-accessible" multiple="" data-placeholder="Sélectionner les Categories" style="width: 100%;" tabindex="-1" aria-hidden="true" name="categories[]">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                    @foreach ($post->categories as $postCategory)
                      @if ($postCategory->id == $category->id)
                        selected
                      @endif
                    @endforeach
                    >{{ $category->name }}</option>
                    @endforeach
                  </select>
                </div>
                
              </div>
            </div>
            <!-- /.box-body -->
            
            <div class="box">
             <div class="box-header">
               <h3 class="box-title">Contenu</h3>
               <!-- tools box -->
               <div class="pull-right box-tools">
                 <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                   <i class="fa fa-minus"></i></button>
                 </div>
                 <!-- /. tools -->
               </div>
               <!-- /.box-header -->
               <div class="box-body pad">
                <textarea name="body" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="editor1">{{ $post->body }}</textarea>
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
      //bootstrap WYSIHTML5 - text editor
      $(".textarea").wysihtml5();
    });
</script>
<script>
  $(document).ready(function() {
    $(".select2").select2();
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

     $('#title').keyup(function(e) {
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