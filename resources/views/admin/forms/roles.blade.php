
<div class="form-group">
    {!! Form::label('name', __('admin.name'), ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Jhon Doe', 'aria-label' => 'admin.permission', 'aria-describedby' => 'basic-icon-default-fullname', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('label', __('admin.label'), ['class' => 'form-label']) !!}
    {!! Form::text('label', null, ['class' => 'form-control', 'placeholder' => 'Permission label', 'aria-describedby' => 'basic-icon-default-label2', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('permission_list', __('admin.label'), ['class' => 'form-label']) !!}
    {!! Form::select('permission_list[]', $permissions, null, ['class' => 'form-control select2', 'placeholder' => 'Permissions..', 'aria-describedby' => 'basic-icon-default-label2', 'required', 'multiple']) !!}
</div>

<button type="submit" class="btn btn-primary mr-1 data-submit">{{ $submitButtonText }}</button>
<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.cancel') }}</button>

<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>