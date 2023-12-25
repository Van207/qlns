@include('layout.header')
<div class="content">
	@if (session('msg'))
		<div class="alert alert-success">
			{{ session('msg') }}
		</div>
	@endif

	<div class="row">
		<div class="col-lg-6 col-md-12 col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">
						<h5>Danh sách người dùng</h5>
					</div>
				</div>

				<div class="card-body">
					<div class="row">
						@foreach ($users as $user)
							<div class="col-md-6 col-lg-4 col-6">
								<div class="card">
									{{-- <div class="card-header">
									
								</div> --}}
									<div class="card-body">
										<h6><a href="#">{{ $user->name }}</a></h6>
										<p>{{ $user->email }}</p>
									</div>
									<div class="card-footer">
										<a href="{{ route('user.delete', $user->id) }}" class="text-danger">Xóa</a>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-6 col-md-12 col-12">
			@if (session('err'))
				<div class="alert alert-danger">
					{{ session('err') }}
				</div>
			@endif
			<div class="card">
				<div class="card-header">
					<h5>Tạo tài khoản người dùng</h5>
				</div>
				<div class="card-body">
					<form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
						@csrf
						<div class="mb-4">
							<div class="row mb-3">
								<label class="col-form-label col-lg-2">Tên người dùng</label>
								<div class="col-lg-10">
									<input type="text" name="name" class="form-control" value="{{ old('name') }}">
									@error('name')
										<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="row mb-3">
								<label class="col-form-label col-lg-2">Email</label>
								<div class="col-lg-10">
									<input type="email" name="email" class="form-control" placeholder="name@example.com" value="{{ old('email') }}">
									@error('email')
										<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="row mb-3">
								<label class="col-form-label col-lg-2">Mật khẩu</label>
								<div class="col-lg-10">
									<input type="password" name="password" class="form-control">
									@error('password')
										<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="row mb-3">
								<label class="col-form-label col-lg-2">Xác nhận lại mật khẩu</label>
								<div class="col-lg-10">
									<input type="password" name="repassword" class="form-control">
									@error('repassword')
										<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
									@enderror
								</div>
							</div>
						</div>
						<button type="submit" class="btn btn-success">Tạo tài khoản</button>
					</form>
				</div>
			</div>
		</div>


	</div>



</div>
@include('layout.footer')
