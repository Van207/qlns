@include('layout.header')
<div class="content">
	@if (session('msg'))
		<div class="alert alert-success">
			{{ session('msg') }}
		</div>
	@endif
	<div class="row">
		<div class="col-md-12 col-lg-12 col-12">
			<div class="card">
				<div class="card-header d-flex justify-content-between">
					<h5 class="mb-0">Cơ quan, đơn vị</h5>
					<a href="{{ route('menu.create') }}" class="btn btn-primary">Thêm cơ quan, đơn vị</a>
				</div>
				<div class="card-body">
					<div class="filter-wrapper">
						<form action="{{ route('menu.filter') }}" method="GET">
							<div class="row mb-4 align-items-end">
								<div class="col-md-3">
									<label class="col-form-label">Tên cơ quan/đơn vị</label>
									<input type="text" class="form-control select_filter" name="title" value="{{ request('title') }}">
								</div>
								<div class="col-md-3">
									<label class="col-form-label">Trực thuộc</label>
									<select class="form-select select select_filter" name="parent_id">
										<option value="0" {{ request('parent_id') == 0 ? 'selected' : '' }}>---------------</option>
										@foreach ($menu_select as $m)
											<option value="{{ $m->id }}" {{ request('parent_id') == $m->id ? 'selected' : '' }}>{{ $m->title }}</option>
										@endforeach
									</select>
								</div>

								<div class="col-md-3">
									<button type="submit" class="btn btn-success mt-3">Lọc thông tin</button>
								</div>
							</div>
						</form>
					</div>
					<table class="table datatable-basic table-hover table-bordered">
						<thead>
							<tr>
								<th>STT</th>
								<th>Cơ quan, đơn vị</th>
								<th>Trực thuộc</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($menus as $menu)
								<tr>
									<td>{{ $menu->id }}</td>
									<td><a href="{{ route('menu.edit', $menu->id) }}">{{ $menu->title }}</a></td>
									<td>
										@if ($menu->parent_id != 0)
											{{ DB::table('menu')->where('id', $menu->parent_id)->first()->title }}
										@endif
									</td>
									<td><a href="{{ route('menu.delete', $menu->id) }}" class="btn btn-outline-danger"><i class="ph-trash"></i></a></td>
								</tr>
							@endforeach
						</tbody>
					</table>

					<div class="pagination_wrapper text-center mb-3 mt-4">
						{{ $menus->links() }}
					</div>

				</div>
			</div>
		</div>

	</div>


</div>
@include('layout.footer')
