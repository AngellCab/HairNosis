@extends('layouts/contentLayoutMaster')

@section('title', __($title))

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-user.css')) }}">
@endsection

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@section('content')

@if (!$branches)
<div class="card container py-2">
	{!! Form::open(['data-remote', 'url' => route('initialize.initialize'), 
		"files" => true, "enctype" => "multipart/form-data", "class" => "create-branch"]) !!}

	<div class="row">
		<div class="col">
			<div class="d-flex justify-content-between">
				<h3>Logo</h3>
				<svg xmlns="http://www.w3.org/2000/svg" class="text-primary my-auto" width="18" height="18" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
					<path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z"/>
					<path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z"/>
				</svg>
			</div>
			<div class="d-flex justify-content-end h-100">
				<input type="file" name="logo" class="form-control m-auto">
			</div>
		</div>
		<div class="col">

			<div class="d-flex justify-content-between">
				<h3>Crear tu primera sucursal</h3>
				<svg xmlns="http://www.w3.org/2000/svg" class="text-primary my-auto" width="18" height="18" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
					<path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
					<path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
				</svg>
			</div>

			<div class="form-group">
				{!! Form::label('name', __('admin.name'), ['class' => 'form-label']) !!}
				{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Lambda', 'aria-label' => 'admin.name', 'aria-describedby' => 'basic-icon-default-name', 'required']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('address', __('admin.address'), ['class' => 'form-address']) !!}
				{!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Permission address', 'aria-describedby' => 'basic-icon-default-address']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('phone', __('admin.phone'), ['class' => 'form-label']) !!}
				{!! Form::tel('phone', null, ['class' => 'form-control', 'placeholder' => '...', 'aria-label' => '...', 'aria-describedby' => 'basic-icon-default-phone']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('email', __('admin.email'), ['class' => 'form-email']) !!}
				{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => '...', 'aria-label' => '...', 'aria-describedby' => 'basic-icon-default-email']) !!}
			</div>

			<button type="submit" class="btn btn-primary mr-1 data-submit">{{ __('admin.save') }}</button>
			<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.cancel') }}</button>
	
		</div>
	</div>
	{!! Form::close() !!}
</div>
@endif

@endsection

@section('vendor-script')
    {{-- Vendor js files --}}
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap4.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection

@section('page-script')
    <!-- Your js -->
	<script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function () { 

			const csrftoken = $('meta[name=csrf-token]').prop('content')
			
			$('.create-branch').on('submit', function(event) {
				event.preventDefault()

				var formData = new FormData(this);
        		var form     = $(this);

				Swal.fire({
					title: form.data('remote-confirm-title'),
					text: form.data('remote-confirm-message'),
					icon: 'question',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: form.data('remote-confirm-button')
				}).then((result) => {
					if (result.isConfirmed) {

						//$.blockUICustom();

						$.ajax({
							url: form.prop('action'),
							type: form.prop('method'),
							headers: {
								'X-CSRF-TOKEN': csrftoken
							},
							data: formData,
							cache: false,
							contentType: false,
							processData: false,
							success: function (response) {
								$.unblockUI();

								if (response.error) {
									if (response.html) {
										Swal.fire({title: 'Error', html: response.html, icon: 'warning'})
										return false
									}

									Swal.fire('Error', response.message, 'warning')
									return false
								}

								Swal.fire('Ok!', form.data('remote-success-message'), 'success')
								location.href = "/"
								
							}, error: catchError
						})
					}
				})
			})

			var catchError = function (jqXhr, json, errorThrown) {
				$.unblockUI()

				var errors     = jqXhr.responseJSON
				var errorsHtml = "<p>"+ errors.message +"</p><ul class='text-left list-inside'>"
				$.each(errors.errors, function (key, value) {
					errorsHtml += '<li>' + value[0] + '</li>'
				});
				errorsHtml += '</ul>'

				Swal.fire('Error', errorsHtml, 'error')
				console.log(jqXhr.responseJSON)
			}
        })
    </script>
@endsection