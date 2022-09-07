@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
<link href="{{ asset('admin/bootstrap/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection

@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Liste des Podcasts
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Accueil</a></li>
      <li><a href="{{ route('post.index') }}">Liste des Podcasts</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Podcasts</h3>
        @can('posts.create', Auth::user())
          <a class='col-lg-offset-5 btn btn-success' href="{{ route('post.create') }}">Ajouter un Podcast</a>
        @endcan
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body" style="overflow-x: auto;">
        <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>ID</th>
                          <th>Titre</th>
                          <th>Sous-Titre</th>
                          <th>Slug</th>
                          <th>Date de création</th>
                          @can('posts.update',Auth::user())
                          <th>Etat</th>
                          <th>Gestion</th>
                          @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($posts as $post)
                          <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->subtitle }}</td>
                            <td>{{ $post->slug }}</td>
                            <td>{{ $post->created_at }}</td>

                            @can('posts.update',Auth::user())
                              <td><input data-id="{{ $post->id }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $post->status ? 'checked' : '' }}></td>
                              <td><a href="{{ route('post.edit',$post->id) }}"><span class="glyphicon glyphicon-edit"></span></a>
                            @endcan

                            @can('posts.delete', Auth::user())
                              <form id="delete-form-{{ $post->id }}" method="post" action="{{ route('post.destroy',$post->id) }}" style="display: none">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                              </form>
                              <a href="" onclick="
                              if(confirm('Êtes-vous sûr de vouloir supprimer ce Podcast ?'))
                                  {
                                    event.preventDefault();
                                    document.getElementById('delete-form-{{ $post->id }}').submit();
                                  }
                                  else{
                                    event.preventDefault();
                                  }" ><span class="glyphicon glyphicon-trash"></span></a>
                            </td>
                          @endcan
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
      </div>

    </div>
    <!-- /.box -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@section('footerSection')
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/bootstrap/js/bootstrap-toggle.min.js') }}"></script>
<script>
  $(function () {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var podcast_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/admin/post_Status',
            data: {'status': status, 'podcast_id': podcast_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
    $("#example1").DataTable();

  });
</script>
@endsection