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
    Liste des Page Informaives
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Accueil</a></li>
      <li><a href="{{ route('gestion-page-informative.index') }}"> Liste des Page Informaives</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Page Informaives</h3>
        <a class='col-lg-offset-5 btn btn-success' href="{{ route('gestion-page-informative.create') }}">Ajouter une Page Informaives</a>
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
                          <th>Titre</th>
                          <th>Slug</th>
                          <th>Gestion</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($pageinformatives as $pageinformative)
                          <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $pageinformative->titre }}</td>
                            <td>{{ $pageinformative->slug }}</td>
                              <td><a href="{{ route('gestion-page-informative.edit',$pageinformative->id) }}"><span class="glyphicon glyphicon-edit"></span></a>
                                <form id="delete-form-{{ $pageinformative->id }}" method="post" action="{{ route('gestion-page-informative.destroy',$pageinformative->id) }}" style="display: none">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                </form>
                                <a href="" onclick="
                                if(confirm('Êtes-vous sûr de vouloir supprimer ce page informative ?'))
                                    {
                                      event.preventDefault();
                                      document.getElementById('delete-form-{{ $pageinformative->id }}').submit();
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