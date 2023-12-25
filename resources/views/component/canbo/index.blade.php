@include('layout.header')
<div class="content">
	@if (session('msg'))
		<div class="alert alert-success">
			{{ session('msg') }}
		</div>
	@endif
	<div class="card">
		<div class="card-header justify-content-between d-flex">
			<h5 class="mb-0">Danh sách cán bộ</h5>
			<a href="{{ route('canbo.create') }}" class="btn btn-primary mb-3">Thêm cán bộ</a>

		</div>
		<div class="card-body">
			<div class="filter-wrapper">
				<form action="{{ route('canbo.filter') }}" method="GET">
					<div class="row mb-4">
						<div class="col-md-3">
							<label class="col-form-label">Họ tên</label>
							<input type="text" class="form-control select_filter" name="hoten" value="{{ request('hoten') }}">
						</div>
						<div class="col-md-3">
							<label class="col-form-label">Cơ quan, đơn vị</label>
							<select class="form-select select select_filter" name="menu_id">
								<option value="0" {{ request('menu_id') == 0 ? 'selected' : '' }}>---------------</option>
								@foreach ($menus as $m)
									<option value="{{ $m->id }}" {{ request('menu_id') == $m->id ? 'selected' : '' }}>{{ $m->title }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-3">
							<label class="col-form-label">Giới tính</label>
							<select class="form-select select select_filter" name="gioitinh">
								<option value="0" {{ request('gioitinh') == 0 ? 'selected' : '' }}>---------------</option>
								<option value="1" {{ request('gioitinh') == 1 ? 'selected' : '' }}>Nam</option>
								<option value="2" {{ request('gioitinh') == 2 ? 'selected' : '' }}>Nữ</option>
							</select>
						</div>
						<div class="col-md-3">
							<label class="col-form-label">Dân tộc</label>
							<select class="form-select select select_filter" name="dantoc_id">
								<option value="0" {{ request('dantoc_id') == 0 ? 'selected' : '' }}>---------------</option>
								@foreach ($dantocs as $dantoc)
									<option value="{{ $dantoc->id }}" {{ request('dantoc_id') == $dantoc->id ? 'selected' : '' }}>{{ $dantoc->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="col-md-3">
							<button type="submit" class="btn btn-success mt-3">Lọc thông tin</button>
						</div>
					</div>
				</form>
			</div>

			<table class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>Họ và tên</th>
						<th>Hình ảnh</th>
						<th>Cơ quan, đơn vị</th>
						<th>Ngày sinh</th>
						<th>Dân tộc</th>
						<th>Quê quán</th>
						<th>Chức vụ</th>
						<th with="50px">Link</th>
						<th with="100px">Keyword</th>
						<th width="100px">Action</th>
					</tr>
				</thead>
				<tbody class="canbo_container">
					@if (count($canbo_all) > 0)
						@foreach ($canbo_all as $canbo)
							<tr>
								<td><a href="{{ route('canbo.edit', $canbo->id) }}">{{ $canbo->hoten }}</a></td>
								<td>
									<img src="{{ asset('images/canbo/' . $canbo->hinhanh) }}" alt="{{ $canbo->hoten }}" class="img-thumbnail rounded-pill" width="100px">
								</td>
								<td>
									{{ $canbo->menu->title }}
								</td>
								<td>{{ date('d-m-Y', strtotime($canbo->ngaysinh)) }}</td>

								<td>{{ $canbo->dantoc->name }}</td>
								<td>{{ $canbo->quequan }}</td>
								<td>{{ $canbo->chucvu }}</td>
								<td with="50px">{{ $canbo->link_search }}</td>
								<td>{{ $canbo->keyword }}</td>
								<td>
									<a class="btn btn-danger" href="{{ route('canbo.delete', $canbo->id) }}"><i class="ph-trash"></i></a>
								</td>
							</tr>
						@endforeach
					@else
						<tr>
							<td colspan="10">
								<p class="text-danger text-center">Không có dữ liệu</p>
							</td>
						</tr>
					@endif


				</tbody>
			</table>
			<div class="pagination_wrapper text-center mt-4 mb-2">
				{{ $canbo_all->links() }}
			</div>

		</div>


	</div>


</div>
@include('layout.footer')
<script>
	// Gửi yêu cầu Ajax khi giá trị của dropdown thay đổi
	// $('.select_filter').on('change', function() {
	// 	// Lấy giá trị của các dropdown
	// 	var menuId = $('select[name="menu_id"]').val();
	// 	var gioiTinh = $('select[name="gioitinh"]').val();
	// 	var danTocId = $('select[name="dantoc_id"]').val();
	// 	var hoten = $('input[name="hoten"]').val();

	// 	// Gửi yêu cầu Ajax đến route 'filter-data' trong Laravel
	// 	$.ajax({
	// 		url: 'canbo/filter',
	// 		type: 'GET',
	// 		data: {
	// 			hoten: hoten,
	// 			menu_id: menuId,
	// 			gioitinh: gioiTinh,
	// 			dantoc_id: danTocId
	// 		},
	// 		beforeSend: function() {
	// 			$('.loading-overlay').show();
	// 		},
	// 		success: function(data) {
	// 			console.log(data);
	// 			$('.canbo_container').html('');
	// 			$('.pagination_wrapper').html('');
	// 			if (data.length > 0) {
	// 				data.forEach(function(data) {
	// 					$('.canbo_container').append(
	// 						`<tr>
	// 							<td>
	// 								<a href="/canbo/edit/${data.id}">${data.hoten}</a>

	// 							</td>
	// 							<td><img src="${window.location.protocol + '//' + window.location.host + '/images/canbo/' + data.hinhanh}" alt="${data.hoten}" class="img-thumbnail rounded-pill" width="100px"></td>
	// 							<td>${data.menu_id}</td>
	// 							<td>${data.ngaysinh}</td>
	// 							<td>${data.dantoc_id}</td>
	// 							<td>${data.quequan}</td>
	// 							<td>${data.chucvu}</td>
	// 							<td>${data.link_search}</td>
	// 							<td>${data.keyword}</td>
	// 							<td>
	// 								<a class="btn btn-danger" href="/canbo/delete/${data.id}"><i class="ph-trash"></i></a>
	// 							</td>
	// 						</tr>`
	// 					)

	// 				})
	// 			} else {
	// 				$('.canbo_container').append(
	// 					`<tr>
	// 						<td colspan="10"><p class='text-danger text-center'>Không có dữ liệu</p></td>
	// 					</tr>`
	// 				)
	// 			}
	// 		},
	// 		error: function(xhr) {
	// 			// Xử lý lỗi nếu có
	// 		}
	// 	});
	// });
</script>
