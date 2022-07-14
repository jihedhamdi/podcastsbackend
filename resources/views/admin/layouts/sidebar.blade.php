<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->


      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
            <li class=""><a href="{{ route('post.index') }}"><i class="fa fa-circle-o"></i> Posts</a></li>
            @can('posts.category',Auth::user())
            <li class=""><a href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i> Categories</a></li>
            @endcan
            @can('posts.tag',Auth::user())
            <li class=""><a href="{{ route('tag.index') }}"><i class="fa fa-circle-o"></i> Tags</a></li>
            @endcan
            <li class=""><a href="{{ route('user.index') }}"><i class="fa fa-circle-o"></i> Users</a></li>
            <li class=""><a href="{{ route('role.index') }}"><i class="fa fa-circle-o"></i> Roles</a></li>
            <li class=""><a href="{{ route('permission.index') }}"><i class="fa fa-circle-o"></i> Permissions</a></li>
            <li class=""><a href="{{ route('authors.index') }}"><i class="fa fa-circle-o"></i> Authors</a></li>
        </li>
        
        
        
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>