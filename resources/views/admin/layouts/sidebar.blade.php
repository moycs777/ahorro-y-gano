<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          {{-- <p>Usuario:</p> --}}
          <div>{{Auth::user()->name}} </div>
          <p>{{Auth::user()->email}} </p>
        </div>
      </div>
      <!-- search form -->
    {{--   <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form> --}}
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">Opciones</li>
        <li class="active treeview">

            @if(Auth::user()->level < 5)
              <li class=""><a href="{{ route('store.index') }}"><i class="fa fa-circle-o"></i> Tiendas</a></li>
            @endif

            @if(Auth::user()->level ==5)
             <li class=""><a href="{{ route('promotion.index') }}"><i class="fa fa-circle-o"></i> Anuncios</a></li>
             <li class=""><a href="{{ route('coupon.index') }}"><i class="fa fa-circle-o"></i> Cupones</a></li>
             
             <li class=""><a href="{{ route('debt.index') }}"><i class="fa fa-circle-o"></i> Deudas</a></li>
             <li class=""><a href="{{ route('invoice.index') }}"><i class="fa fa-circle-o"></i> Facturas</a></li>
            @endif

            @if(Auth::user()->level <4)
             <li class=""><a href="{{ route('commission.index') }}"><i class="fa fa-circle-o"></i> Comisiones</a></li>
            @endif

            @if(Auth::user()->level ==1)
              <li class=""><a href="{{ route('clasification.index') }}"><i class="fa fa-circle-o"></i> Sectores</a></li>
              <li class=""><a href="{{ route('payment.index') }}"><i class="fa fa-circle-o"></i> Pagos</a></li>
              <li class=""><a href="{{ route('competition.index') }}"><i class="fa fa-circle-o"></i> Concursos</a></li>
            @endif
            
            {{-- Tutorial --}}
            {{-- <li class=""><a href="{{ route('post.index') }}"><i class="fa fa-circle-o"></i> Posts</a></li>
            <li class=""><a href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i> Categorias</a></li>
            <li class=""><a href="{{ route('tag.index') }}"><i class="fa fa-circle-o"></i> Etiquetas</a></li> --}}

            @if(Auth::user()->level <5)
              <li class=""><a href="{{ route('user.index') }}"><i class="fa fa-circle-o"></i> Usuarios</a></li>
            @endif
              
              <li class=""><a href="{{ route('ranking') }}"><i class="fa fa-circle-o"></i> Puntuacion del concurso</a></li>

            <li class=""><a href="{{ route('raiz') }}"><i class="fa fa-circle-o"></i> Index</a></li>
        </li>
        
        
        
       
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>