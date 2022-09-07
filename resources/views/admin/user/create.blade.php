@extends('admin.layouts.app')

@section('main-content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
	  <section class="content-header">
      @include('admin.layouts.pagehead')
	    <h1>
			Ajouter un Admin
	    </h1>
	    <ol class="breadcrumb">
	      <li><a href="{{ route('admin.home') }}"><i class="fa fa-dashboard"></i> Accueil</a></li>
	      <li><a href="{{ route('user.index') }}">Liste des Admins</a></li>
	      <li class="active">Ajouter un Admin</li>
	    </ol>
	  </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Ajouter un Admin</h3>
            </div>

            @include('includes.messages')
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="{{ route('user.store') }}" method="post">
            {{ csrf_field() }}
              <div class="box-body">
              <div class="col-lg-offset-3 col-lg-6">
                <div class="form-group">
                  <label for="name">Nom</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Admin Nom" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                  <label for="phone">téléphone</label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="téléphone" value="{{ old('phone') }}">
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
                    <label ><input type="checkbox" name="status" @if (old('status') == 1)
                      checked
                    @endif value="1">Etat</label>
                  </div>
                </div>

                <div class="form-group">
                <label>Attribuer les rôles</label>
                <div class="row">
                  @foreach ($roles as $role)
                      <div class="col-lg-3">
                        <div class="checkbox">
                          <label ><input type="checkbox" name="role[]" value="{{ $role->id }}"> {{ $role->name }}</label>
                        </div>
                      </div>
                  @endforeach
                </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href='{{ route('user.index') }}' class="btn btn-warning">Retour</a>
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