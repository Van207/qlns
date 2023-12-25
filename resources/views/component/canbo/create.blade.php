@push('scripts')
	<script src="<?= asset('assets/js/vendor/editors/ckeditor/ckeditor_classic.js') ?>"></script>
	<script src="<?= asset('assets/demo/pages/editor_ckeditor_classic.js') ?>"></script>
@endpush
@include('layout.header')

<div class="content">
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0 text-center">Thêm cán bộ</h5>
			<a href="{{ route('canbo.index') }}" class="btn btn-outline-warning"><i class="ph-arrow-bend-up-left"></i> Back</a>
		</div>

		<div class="card-body">
			@if (session('status'))
				<div class="alert alert-success mb-1 mt-1">
					{{ session('status') }}
				</div>
			@endif
			<form action="{{ route('canbo.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="mb-4">
					{{-- <div class="fw-bold border-bottom pb-2 mb-3">Basic examples</div> --}}
					<div class="row mb-3">
						<label class="col-form-label col-lg-2">Họ tên</label>
						<div class="col-lg-10">
							<input type="text" name="hoten" class="form-control">
							@error('hoten')
								<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="row mb-3">
						<label class="col-form-label col-lg-2">Ảnh đại diện</label>
						<div class="col-lg-10">
							<!-- AJAX upload -->
							<div class="card">
								<div class="card-body">
									<input type="file" name="hinhanh" class="file-input-ajax" multiple="false">
								</div>
							</div>
							<!-- /AJAX upload -->
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-lg-2">Ngày sinh</label>
						<div class="col-lg-3">
							<input class="form-control" type="date" name="ngaysinh">
							@error('ngaysinh')
								<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="row mb-3">

						<p class="fw-semibold col-lg-2">Giới tính</p>
						<div class="col-lg-3">
							<div class="border p-3 rounded">
								<div class="form-check mb-2">
									<input type="radio" class="form-check-input" name="gioitinh" id="nam" value="1">
									<label class="form-check-label" for="nam">Nam</label>
								</div>

								<div class="form-check mb-3">
									<input type="radio" class="form-check-input" name="gioitinh" id="nu" value="2">
									<label class="form-check-label" for="nu">Nữ</label>
								</div>

								@error('ngaysinh')
									<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
								@enderror
							</div>
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-lg-2">Dân tộc</label>
						<div class="col-lg-10">
							<select class="form-control select" name="dantoc_id">
								<option value="1">______________</option>
								@foreach ($dantocs as $dantoc)
									<option value="{{ $dantoc->id }}">{{ $dantoc->name }}</option>
								@endforeach

							</select>
						</div>
					</div>

					<div class="row mb-3">
						<label class="col-form-label col-lg-2">Quê quán</label>
						<div class="col-lg-10">
							<input type="text" name="quequan" class="form-control">
							@error('quequan')
								<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
							@enderror

						</div>
					</div>
					<div class="row mb-3">
						<label class="col-form-label col-lg-2">Chức vụ</label>
						<div class="col-lg-10">
							<input type="text" name="chucvu" class="form-control">
							@error('chucvu')
								<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
							@enderror

						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-form-label col-lg-2">Cơ quan đơn vị</label>
						<div class="col-lg-10">
							<select class="form-control select" name="menu_id">
								<option value="0">---------</option>
								@foreach ($menus as $m)
									<option value="{{ $m->id }}">{{ $m->title }}</option>
								@endforeach

							</select>
						</div>
					</div>
					<div class="row mb-3">
						<label class="col-form-label col-lg-2">Trình độ chuyên môn</label>
						<div class="col-lg-10">
							<input type="text" name="trinhdochuyenmon" class="form-control">
							@error('trinhdochuyenmon')
								<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="row mb-3">
						<label class="col-form-label col-lg-2">Lý luận chính trị</label>
						<div class="col-lg-10">
							<input type="text" name="liluanchinhtri" class="form-control">
							@error('liluanchinhtri')
								<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="row mb-3">
						<label class="col-form-label col-lg-2">Quá trình công tác</label>
						<div class="col-lg-10">
							<textarea class="form-control" id="ckeditor_classic_empty" name="quatrinhcongtac" placeholder=""></textarea>
						</div>
					</div>
					<div class="row mb-3">
						<label class="col-form-label col-lg-2">Keywords</label>
						<div class="col-lg-10">
							<textarea name="keyword" class="form-control" placeholder="Ngăn cách nhau bởi dấu phẩy"></textarea>
						</div>
					</div>
					<div class="row mb-3">
						<label class="col-form-label col-lg-2">Link báo tìm kiếm</label>
						<div class="col-lg-10">
							<textarea name="link_search" class="form-control" placeholder="https://www.example1.com, https://www.exampl2.com"></textarea>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-success">Lưu thông tin</button>
			</form>
		</div>
	</div>
</div>
@include('layout.footer')
