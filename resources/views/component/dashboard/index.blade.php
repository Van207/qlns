@push('css')
	<link href="<?= asset('assets/css/custom.css') ?> " id="stylesheet" rel="stylesheet" type="text/css">
@endpush

@include('layout.header')
<div class="content">
	@if (session('msg'))
		<div class="alert alert-success">
			{{ session('msg') }}
		</div>
	@endif


	<div class="row">
		<div class="col-md-6 col-lg-4">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<h5>Cơ quan, đơn vị</h5>
					</div>

				</div>

				<div class="card-body">
					<div class="row mb-3">
						<label class="col-form-label col-lg-3">Search</label>
						<div class="col-lg-9">
							<input type="text" name="search" class="form-control" id="search_menu">

						</div>
					</div>
					<div class="p-0 menu-wrapper">
						@foreach ($menus as $menu)
							<ul class="menu-ul @php echo "menu_id_".$menu->id @endphp">
								<li>
									<p class="menu_link" data-menu-id="{{ $menu->id }}">{{ $menu->title }}</p>
								</li>

								@if (count($menu->children))
									@include('component.dashboard.tree', ['menus' => $menu->children])
								@endif

								<div class="menu-ul_icon" data-menu-id="{{ $menu->id }}">
									<i class="ph-plus"></i>
									<i class="ph-minus d-none"></i>
								</div>
							</ul>
						@endforeach


					</div>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-lg-8">
			<div class="card">
				<div class="card-header">
					<div class="card-title canbo-list">
						<h5>Danh sách cán bộ</h5>
					</div>

				</div>

				<div class="card-body">
					<div class="row" id="data-container">

					</div>
				</div>
			</div>
		</div>
	</div>



</div>
@include('layout.footer')


<script>
	$(document).ready(function() {
		ajaxMenu();
		searchMenu();
		collapseMenu();
	})

	const ajaxMenu = function() {
		var menu_links = document.querySelectorAll('.menu_link');
		menu_links.forEach(function(menu_link) {
			$(menu_link).click(function() {
				var menu_id = $(menu_link).data('menu-id');
				$("#data-container").html('')
				$.ajax({
					url: window.location.protocol + '//' + window.location.host + '/getCanbo/' + menu_id,
					method: "GET",
					success: function(data) {
						// Hiển thị dữ liệu trực tiếp lên trang

						$('.canbo-list > h5').text('Danh sách cán bộ ' + data.menu.title)

						if (data.canbo.length > 0) {
							data.canbo.forEach(function(canbo) {
								$("#data-container").append(`
									<div class="col-md-6 col-lg-3">
										<div class="card">
											<img class="card-img-top" src="${window.location.protocol + '//' + window.location.host + '/images/canbo/' + canbo.hinhanh}" alt="${canbo.hoten}">
											<div class="card-body">
												<h5 class="card-title">${canbo.hoten}</h5>
												<p class="card-text">Texting</p>
											</div>
										</div>
									</div>
								`);
							})
						} else {
							$("#data-container").append(`<p class='text-danger'>Không có dữ liệu</p>`)
						}


					},
					error: function(error) {
						console.log(error);
					}
				});

			});
		});
	}

	const collapseMenu = function() {
		const menuIcons = document.querySelectorAll('.menu-ul_icon');
		menuIcons.forEach(menuIcon => {
			menuIcon.addEventListener('click', () => {
				const menuId = menuIcon.getAttribute('data-menu-id');
				const menuUl = document.querySelector(`.menu_id_${menuId}`);

				if (menuUl.style.maxHeight === '40px' || menuUl.style.maxHeight === '') {
					menuUl.style.maxHeight = 'unset'; // Thay đổi kích thước tùy ý

					const plus = menuIcon.querySelector('.ph-plus');
					const minus = menuIcon.querySelector('.ph-minus');
					plus.classList.add('d-none');
					minus.classList.remove('d-none');
				} else {
					menuUl.style.maxHeight = '40px';

					const plus = menuIcon.querySelector('.ph-plus');
					const minus = menuIcon.querySelector('.ph-minus');
					plus.classList.remove('d-none');
					minus.classList.add('d-none');
				}

			});
		});
	}

	const searchMenu = function() {
		const searchInput = $('#search_menu');
		const list = $('.menu-wrapper');

		searchInput.on('input', function() {
			const searchTerm = searchInput.val().toLowerCase();

			list.find('li').each(function() {
				const mainItem = $(this);
				const mainItemText = mainItem.find('p').text().toLowerCase();

				if (mainItemText.includes(searchTerm)) {
					mainItem.show();
					mainItem.find('ul li').show();
					// $('.menu-ul_icon').show();
				} else {
					mainItem.hide();
					mainItem.find('ul li').hide();
					// $('.menu-ul_icon').hide();

				}
			});
		});
	}
</script>
