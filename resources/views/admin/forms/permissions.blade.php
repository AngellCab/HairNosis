
<div class="form-group">
    {!! Form::label('name', __('admin.name'), ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Jhon Doe', 'aria-label' => 'admin.permission', 'aria-describedby' => 'basic-icon-default-fullname', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('label', __('admin.label'), ['class' => 'form-label']) !!}
    {!! Form::text('label', null, ['class' => 'form-control', 'placeholder' => 'Permission label', 'aria-describedby' => 'basic-icon-default-label2', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', __('admin.description'), ['class' => 'form-label']) !!}
    {!! Form::text('description', null, ['class' => 'form-control', 'placeholder' => '...', 'aria-label' => '...', 'aria-describedby' => 'basic-icon-default-description']) !!}
</div>

<button type="submit" class="btn btn-primary mr-1 data-submit">{{ $submitButtonText }}</button>
<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.cancel') }}</button>