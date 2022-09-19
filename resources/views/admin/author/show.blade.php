@extends('admin.layouts.app')

@section('headSection')
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables/dataTables.bootstrap.css') }}">
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
    Liste des Auteurs
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Accueil</a></li>
      <li><a href="{{ route('authors.index') }}">Liste des Auteurs</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Auteurs</h3>
        <a class='col-lg-offset-5 btn btn-success' href="{{ route('authors.create') }}">Ajouter un auteur</a>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body" style="overflow-x: auto;">
        <div class="box">

                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>ID</th>
                          <th>Nom et Prénom</th>
                          <th>Slug</th>
                          <th>Email</th>
                          <th>Couleur</th>
                          <th>Image</th>
                          <th>Gestion</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($authors as $author)
                          <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->slug }}</td>
                            <td>{{ $author->email }}</td>
                            <td>{{ $author->color }}</td>
                            <td>@if( $author->image)
                                <img src="{{asset('storage/'.'/author/'.$author->image)}}" width="50px" height="50px"/>
                              @endif</td>
                              <td><a href="{{ route('authors.edit',$author->id) }}"><span class="glyphicon glyphicon-edit"></span></a>
                                <form id="delete-form-{{ $author->id }}" method="post" action="{{ route('authors.destroy',$author->id) }}" style="display: none">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                </form>
                                <a href="" onclick="
                                if(confirm('Êtes-vous sûr de vouloir supprimer ce Auteur ??'))
                                    {
                                      event.preventDefault();
                                      document.getElementById('delete-form-{{ $author->id }}').submit();
                                    }
                                    else{
                                      event.preventDefault();
                                    }" ><span class="glyphicon glyphicon-trash"></span></a>
                              </td>
                            </tr>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- /.box-body -->
                  </div>
      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        Footer
      </div>
      <!-- /.box-footer-->
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
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
@endsection