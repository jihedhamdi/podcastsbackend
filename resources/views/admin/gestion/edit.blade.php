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
                Modifier un Utilisateur
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Accueil</a></li>
                <li><a href="{{ route('gestion-users.index') }}">Liste des Utilisateurs</a></li>
                <li class="active">Modifier un Utilisateur</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Utilisateur</h3>
                        </div>
                        @include('includes.messages')
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('gestion-users.update', $user->id) }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}
                            <div class="box-body">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Nom" value="{{ $user->name }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email </label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Email" value="{{ $user->email }}">
                                    </div>
                                    <div class="form-group">

                                        <div class="checkbox">
                                            <label><input type="checkbox" name="email_verified_at" value="1"
                                                    {{ $user->email_verified_at != null ? 'checked' : '' }}>
                                                vérifier</label>
                                                <input type="hidden" class="form-control" id="verified_date" name="verified_date"
                                            value="{{ $user->email_verified_at }}">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="status" value="1"
                                                    {{ $user->status == 1 ? 'checked' : '' }}>suspendu</label>
                                        </div>
                                    </div>

                                </div>

                            </div>


                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary" Value="Enregistrer">
                                <a href="{{ route('gestion-users.index') }}" class="btn btn-warning">Return</a>
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
@endsection
