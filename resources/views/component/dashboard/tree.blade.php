<ul>
	@foreach ($menus as $menu)
		<li>
			
			<p class="menu_link" data-menu-id="{{ $menu->id }}"><i class="ph-file"></i> {{ $menu->title }}</p>
		</li>

		{{-- Check nếu có menu chiild -> thì đệ quy hiển thị ra menu con --}}
		@if (count($menu->children))
			@include('component.dashboard.tree', ['menus' => $menu->children])
		@else
		@endif
	@endforeach
</ul>
