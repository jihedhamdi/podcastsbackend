<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->


      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">NAVIGATION PRINCIPALE</li>
        <li class="active treeview">
            <li class=""><a href="{{ route('post.index') }}"><i class="fa fa-circle-o"></i> Podcasts</a></li>
            @can('posts.category',Auth::user())
            <li class=""><a href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i> Catégories</a></li>
            @endcan
            @can('posts.tag',Auth::user())
            <li class=""><a href="{{ route('tag.index') }}"><i class="fa fa-circle-o"></i> Mots clés</a></li>
            @endcan
            @can('posts.tag',Auth::user())
            <li class=""><a href="{{ route('gestion-users.index') }}"><i class="fa fa-circle-o"></i> Gestion Utilisateurs Client</a></li>
            @endcan
            <li class=""><a href="{{ route('user.index') }}"><i class="fa fa-circle-o"></i> Utilisateurs</a></li>
            <li class=""><a href="{{ route('role.index') }}"><i class="fa fa-circle-o"></i> Les rôles</a></li>
            <li class=""><a href="{{ route('permission.index') }}"><i class="fa fa-circle-o"></i> Autorisations</a></li>
            <li class=""><a href="{{ route('authors.index') }}"><i class="fa fa-circle-o"></i> Auteurs</a></li>
        </li>
        
        
        
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>