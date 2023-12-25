@include('layout.header')
<div class="content">
	<div class="card">
		<div class="card-header">
			<h5 class="mb-0 text-center">Sửa cơ quan, đơn vị</h5>
			<a href="{{ route('menu.index') }}" class="btn btn-outline-warning"><i class="ph-arrow-bend-up-left"></i> Back</a>
		</div>

		<div class="card-body">
			@if (session('status'))
				<div class="alert alert-success mb-1 mt-1">
					{{ session('status') }}
				</div>
			@endif
			<form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				<div class="mb-4">
					<div class="row mb-3">
						<label class="col-form-label col-lg-2">Tên cơ quan đơn vị</label>
						<div class="col-lg-10">
							<input type="text" name="title" class="form-control" value="{{ $menu->title }}">
							@error('title')
								<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
							@enderror
						</div>
					</div>
					<div class="mb-3 row">
						<label class="col-form-label col-lg-2">Trực thuộc</label>
						<div class="col-lg-10">
							<select class="form-control select" name="parent_id">
								<option value="0" @if ($menu->parent_id === 0) selected @endif>---------</option>
								@foreach ($menus as $m)
									<option value="{{ $m->id }}" @if ($menu->parent_id === $m->id) selected @endif>{{ $m->title }}</option>
								@endforeach

							</select>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-success">Lưu thông tin</button>
			</form>
		</div>
	</div>
</div>
@include('layout.footer')
