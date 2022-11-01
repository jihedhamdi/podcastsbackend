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
    Liste des Commentaires
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Accueil</a></li>
      <li><a href="{{ route('comments.index') }}">Liste des Commentaires</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Commentaires</h3>
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
                          <th>Auteur</th>
                          <th>Date</th>
                          <th>Podcast</th>
                          <th>Commentaire</th>
                          <th>Approuve</th>
                          <th>Gestion</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($comments as $comment)
                          <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ $comment->created_at }}</td>
                            <td>{{ $comment->post->id }} - {{ $comment->post->title }}</td>
                            <td>{{ $comment->comment}}</td>
                            
                            @can('posts.comments',Auth::user())
                              <td><input data-id="{{ $comment->id }}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Approved" data-off="InApproved" {{ $comment->Approuve == 0  ? 'checked' : '' }}></td>
                            @endcan
                              <td>
                                <form id="delete-form-{{ $comment->id }}" method="post" action="{{ route('comments.destroy',$comment->id) }}" style="display: none">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                </form>
                                <a href="" onclick="
                                if(confirm('Êtes-vous sûr de vouloir supprimer ce commentaire ?'))
                                    {
                                      event.preventDefault();
                                      document.getElementById('delete-form-{{ $comment->id }}').submit();
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
<script src="{{ asset('admin/bootstrap/js/bootstrap-toggle.min.js') }}"></script>
<script>
  $(function () {
    $('.toggle-class').change(function() {
        var Approuve = $(this).prop('checked') == true ? 0 : 1; 
        var commenter_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/admin/approuvecomment',
            data: {'Approuve': Approuve, 'commenter_id': commenter_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
    $("#example1").DataTable();

  });
</script>

@endsection