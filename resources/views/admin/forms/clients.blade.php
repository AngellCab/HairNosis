
<div class="form-group">
    {!! Form::label('name', __('admin.name'), ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('phone', __('admin.phone'), ['class' => 'form-label']) !!}
    {!! Form::tel('phone', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', __('admin.email'), ['class' => 'form-label']) !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('location_id', __('admin.location'), ['class' => 'form-label']) !!}
    {!! Form::select('location_id', $locations, null, ['class' => 'form-control select2', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('stylist_id', __('admin.stylist'), ['class' => 'form-label']) !!}
    {!! Form::select('stylist_id', $stylists, null, ['class' => 'form-control select2', 'required']) !!}
</div>

<button type="submit" class="btn btn-primary mr-1 data-submit">{{ $submitButtonText }}</button>
<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.cancel') }}</button>

<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>