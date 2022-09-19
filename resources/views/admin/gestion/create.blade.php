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
                Ajouter un Utilisateur
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Accueil</a></li>
                <li><a href="{{ route('gestion-users.index') }}">Liste des Utilisateurs</a></li>
                <li class="active">Ajouter un Utilisateur</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Utilisateurs</h3>
                        </div>
                        @include('includes.messages')
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('gestion-users.store') }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="box-body">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name">Nom</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ old('name') }}" placeholder="Nom">
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="Email" class="form-control" id="email" name="email"
                                            value="{{ old('email') }}" placeholder="email">
                                    </div>

                                    <div class="form-group">
                                        
											<div class="checkbox">
                                          <label ><input type="checkbox" name="email_verified_at" value="1" {{ old('email_verified_at') == 1 ? 'checked' : '' }}> vérifier email</label>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                      <label for="password">Mot de pass</label>
                                      <input type="password" class="form-control" id="password" name="password" placeholder="Mot de pass" value="{{ old('password') }}">
                                    </div>

                                    <div class="form-group">
                                       <label for="password_confirmation">Confirmer Mot de pass</label>
                                       <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmer Mot de pass">
                                    </div>
									
                                    <div class="form-group">
                                      <label for="confirm_passowrd">Etat</label>
                                      <div class="checkbox">
                                          <label ><input type="checkbox" name="status"  value="1" {{ old('status') == 1 ? 'checked' : '' }} >suspendu</label>
                                      </div>
                                    </div>
                                
                            </div>

                            

                            <div class="box-footer">
                                <input type="submit" class="btn btn-primary" Value="Enregistrer">
                                <a href="{{ route('gestion-users.index') }}" class="btn btn-warning">Retour</a>
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
