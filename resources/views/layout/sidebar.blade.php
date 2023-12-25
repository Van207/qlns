<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg h-100">

	<!-- Sidebar content -->
	<div class="sidebar-content">

		<!-- Sidebar header -->
		<div class="sidebar-section">
			<div class="sidebar-section-body d-flex justify-content-center">
				<h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

				<div>
					<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
						<i class="ph-arrows-left-right"></i>
					</button>

					<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
						<i class="ph-x"></i>
					</button>
				</div>
			</div>
		</div>
		<!-- /sidebar header -->


		<!-- Main navigation -->
		<div class="sidebar-section">
			<ul class="nav nav-sidebar" data-nav-type="accordion">

				<!-- Main -->
				<li class="nav-item-header pt-0">
					<div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
					<i class="ph-dots-three sidebar-resize-show"></i>
				</li>
				<li class="nav-item">
					<a href="{{ route('homepage') }}" class="nav-link @if (Request::is('/')) active @endif">
						<i class="ph-activity"></i>
						<span>
							Dashboard
						</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('canbo.index') }}" class="nav-link @if (Request::is('canbo*')) active @endif">
						<i class="ph-users"></i>
						<span>
							Cán bộ
						</span>
					</a>
				</li>


				{{-- <li class="nav-item nav-item-submenu">
					<a href="#" class="nav-link">
						<i class="ph-swatches"></i>
						<span>Themes</span>
					</a>
					<ul class="nav-group-sub collapse">
						<li class="nav-item"><a href="index.html" class="nav-link active">Default</a></li>
						<li class="nav-item"><a href="../../../LTR/material/full/index.html" class="nav-link disabled">Material <span class="badge align-self-center ms-auto">Coming soon</span></a></li>
						<li class="nav-item"><a href="../../../LTR/clean/full/index.html" class="nav-link disabled">Clean <span class="badge align-self-center ms-auto">Coming soon</span></a></li>
					</ul>
				</li> --}}


				<li class="nav-item">
					<a href="{{ route('menu.index') }}" class="nav-link @if (Request::is('coquan*')) active @endif">
						<i class="icon-office"></i>
						<span>
							Cơ quan, đơn vị
						</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('tintuc.index') }}" class="nav-link @if (Request::is('tintuc*')) active @endif">
						<i class="icon-newspaper"></i>
						<span>
							Tin tức
						</span>
					</a>
				</li>
				<li class="nav-item">
					<a href="{{ route('user.index') }}" class="nav-link @if (Request::is('user*')) active @endif">
						<i class="ph-user"></i>
						<span>
							Tài khoản
						</span>
					</a>
				</li>

				<!-- Page kits -->

				<!-- /page kits -->

			</ul>
		</div>
		<!-- /main navigation -->

	</div>
	<!-- /sidebar content -->

</div>
<!-- /main sidebar -->
