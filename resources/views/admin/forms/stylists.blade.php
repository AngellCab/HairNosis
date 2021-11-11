<div class="form-group">
    {!! Form::label('name', __('admin.name'), ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Jhon Doe', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', __('admin.email'), ['class' => 'form-label']) !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'john.doe@example.com', 'required']) !!}
    <small class="form-text text-muted"> You can use letters, numbers & periods </small>
</div>

<div class="form-group">
    {!! Form::label('phone', __('admin.phone'), ['class' => 'form-label']) !!}
    {!! Form::tel('phone', null, ['class' => 'form-control', 'placeholder' => '...', 'required']) !!}
</div>

<button type="submit" class="btn btn-primary mr-1 data-submit">{{ $submitButtonText }}</button>
<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.cancel') }}</button>

<script type="text/javascript">
    $(document).ready(function () { $('.select2').select2(); });
</script>