@include('layout.header')
<div class="content">
	@if (session('msg'))
		<div class="alert alert-success">
			{{ session('msg') }}
		</div>
	@endif

	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<h4>Tin tức về cán bộ</h4>
					</div>
				</div>
				<div class="card-body">
					<table class="table datatable-basic table-hover table-bordered">
						<thead>
							<tr>
								<th width="200px">Cán bộ</th>
								<th>Từ khóa</th>
								<th>Ngày tháng</th>
								<th>Nội dung</th>
								<th>Link</th>
								<th>Xóa</th>
							</tr>
						</thead>
						<tbody>
							@if (count($tintuc) > 0)
								@foreach ($tintuc as $item)
									<tr>
										<td><strong>{{ $item->canbo->hoten }}</strong></td>
										<td>{{ $item->keyword }}</td>

										<td>{{ $item->thoigian }}</td>
										<td>{{ html_entity_decode($item->tieude) }}</td>
										<td><a href="{{ $item->link_goc }}" target="_blank">Xem</a></td>
										<td><a href="{{ route('tintuc.delete', $item->id) }}" class="btn btn-danger"><i class="ph-trash"></i></a></td>
									</tr>
								@endforeach
							@endif

						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>



</div>
@include('layout.footer')
