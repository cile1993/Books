<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Book Store</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
		<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
	</head>
	<body>
        @if(Route::has('login'))
        <ul class="nav justify-content-end">
			<li class="nav-item">
                @auth
                <a class="nav-link active" href="{{ url('/') }}">Home</a>
			<li class="nav-item">
				<a class="nav-link active" href="{{ url('/logout') }}">Logout</a>
            @else
					<a class="nav-link active" href="{{ route('login') }}">Login</a>
			</li>
            @if (Route::has('register'))
            <li class="nav-item">
				<a class="nav-link" href="{{ route('register') }}">Register</a>
			</li>
            @endif
            @endif
		</ul>
        @endif
        <div class="container mt-5">
            @if(session('status'))
            <div class="alert alert-success">
				{{ session('status') }}
			</div>
            @endif

            @can('import')
            <div class="card">
				<div class="card-header font-weight-bold">
					<h2 class="float-left">Import Excel, CSV or XML File</h2>
				</div>
				<div class="card-body">
					<form id="excel-csv-import-form" method="POST" action="{{ url('import-excel-csv-file') }}" accept-charset="utf-8" enctype="multipart/form-data" accept=".csv,.xlsx,.xml"> @csrf <div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="file" name="file" placeholder="Choose file">
								</div>
                                @error('file')
                                <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                @enderror
							</div>
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary" id="submit">Submit</button>
							</div>
						</div>
					</form>
				</div>
			</div>
            @endif

				<div class="card mt-5 mb-5">
					<div class="card-header font-weight-bold mb-3">
						<h2 class="text-center">Books List</h2>
					</div>
				<table class="table table-bordered yajra-datatable">
					<thead>
						<tr>
							<th>
								ID
							</th>
							<th>
								Name
							</th>
							<th>
								Author
							</th>
							<th>
								Publisher
							</th>
							<th>
								Date Published
							</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
		<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
		<script type="text/javascript">
			$(function () {

				let table = $('.yajra-datatable').DataTable({
					order:[[0, "asc"]],
					processing: true,
					serverSide: true,
					ajax: "{{ route('list') }}",
					columnDefs        : [
						{
							'searchable'    : false,
							'targets'       : [1,2]
						},
							],
					columns: [
						{data: 'id', name: 'id'},
						{data: 'name', name: 'name'},
						{data: 'author', name: 'author'},
						{data: 'publisher', name: 'publisher'},
						{data: 'year', name: 'year'},
					]
				});
			});
		</script>
	</body>
</html>
