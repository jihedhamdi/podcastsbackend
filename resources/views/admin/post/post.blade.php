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
                        <form role="form" action="{{ route('post.store') }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="title">Titre</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ old('title') }}" placeholder="Titre">
                                    </div>

                                    <div class="form-group">
                                        <label for="subtitle">Sous-Titre</label>
                                        <input type="text" class="form-control" id="subtitle" name="subtitle"
                                            value="{{ old('subtitle') }}" placeholder="Sous-Titre">
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" class="form-control" id="slug" name="slug"
                                            value="{{ old('slug') }}" placeholder="Slug">
                                    </div>
                                    <div class="form-group">
                                        <label for="slug">mp3 url</label>
                                        <input type="text" class="form-control" id="audio_link" name="audio_link"
                                            value="{{ old('audio_link') }}" placeholder="mp3 url">
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label"><strong>Options</strong></label>
                                      <div class="controls">
                                          <div class="row-fluid">
                                              <div class="span5">
                                                  <table border="0" width="500"     style="display: flex;padding-left: 50px;">
                                                      <tr>
                                                          <td><label class="checkbox line">
                                                                  <input type="checkbox" value="1" name="animation"
                                                                      {{ old('animation') == 1 ? 'checked' : '' }}><strong>Animation
                                                                      à la une</strong>
                                                              </label></td>
                                                      </tr>
                                                      <tr>
                                                          <td><label class="checkbox line">
                                                                  <input type="checkbox" value="1" name="access"
                                                                      {{ old('access') == 1 ? 'checked' : '' }}><strong>
                                                                      Accées limité au abonnées </strong>
                                                              </label></td>
                                                      </tr>
                                                      <tr>
                                                          <td><label class="checkbox line">
                                                                  <input type="checkbox" value="1" name="visible"
                                                                      {{ old('visible') == 1 ? 'checked' : '' }}><strong>
                                                                      Contenu invisible</strong>
                                                              </label></td>
                                                      </tr>
                                                      <tr>
                                                          <td> <label class="checkbox line">
                                                                  <input type="checkbox" name="status" value="1"
                                                                      {{ old('status') == 1 ? 'checked' : '' }}>
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
                                        <div class="pull-left">
                                            <label for="image">Image (405 * 304)</label>
                                            <input type="file" name="image" id="image" value="{{ old('image') }}">
                                            <img id="preview-image-before-upload" src="" alt="preview image"
                                            style="max-height: 250px;width: 250px;display: none;" />
                                        </div>  
                                    </div>
                                    <div class="form-group" style="margin-top:18px;">
                                        <label>Sélectionner les Mots clés</label>
                                        <select class="form-control select2 select2-hidden-accessible" multiple=""
                                            data-placeholder="Sélectionner les Mots clés" style="width: 100%;"
                                            tabindex="-1" aria-hidden="true" name="tags[]">
                                            @foreach ($tags as $tag)
                                                <option value="{{ $tag->id }}"
                                                    @if (in_array($tag->id, old('tags'))) selected @endif>{{ $tag->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-top:18px;">
                                        <label>Sélectionner les Auteurs</label>
                                        <select class="form-control select2 select2-hidden-accessible"
                                            data-placeholder="Sélectionner les Auteurs" style="width: 100%;"
                                            tabindex="-1" aria-hidden="true" name="authors">
                                            @foreach ($authors as $author)
                                                <option value="{{ $author->id }}"
                                                    {{ old('authors') == $author->id ? 'selected' : '' }}>
                                                    {{ $author->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group" style="margin-top:18px;">
                                        <label>Sélectionner les Categories</label>
                                        <select class="form-control select2 select2-hidden-accessible" multiple=""
                                            data-placeholder="Sélectionner les Categories" style="width: 100%;"
                                            tabindex="-1" aria-hidden="true" name="categories[]">
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    @if (in_array($category->id, old('categories'))) selected @endif>{{ $category->name }}
                                                </option>
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
                                        <button type="button" class="btn btn-default btn-sm" data-widget="collapse"
                                            data-toggle="tooltip" title="Collapse">
                                            <i class="fa fa-minus"></i></button>
                                    </div>
                                    <!-- /. tools -->
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body pad">
                                    <textarea name="body"
                                        style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                                        id="editor1">{{ old('body') }}</textarea>
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
    <script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(function() {
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
    <script type="text/javascript">
        $(document).ready(function(e) {


            $('#image').change(function() {

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
