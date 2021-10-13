
<div class="form-group">
    {!! Form::label('name', __('admin.name'), ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Jhon Doe', 'aria-label' => 'admin.permission', 'aria-describedby' => 'basic-icon-default-fullname', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('address', __('admin.address'), ['class' => 'form-address']) !!}
    {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Permission address', 'aria-describedby' => 'basic-icon-default-address2', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('phone', __('admin.phone'), ['class' => 'form-label']) !!}
    {!! Form::tel('phone', null, ['class' => 'form-control', 'placeholder' => '...', 'aria-label' => '...', 'aria-describedby' => 'basic-icon-default-phone']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', __('admin.email'), ['class' => 'form-email']) !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => '...', 'aria-label' => '...', 'aria-describedby' => 'basic-icon-default-email']) !!}
</div>

<div class="form-group">
    {!! Form::label('owner_id', __('admin.owner_id'), ['class' => 'form-owner_id']) !!}
    {!! Form::number('owner_id', null, ['class' => 'form-control', 'placeholder' => '...', 'aria-label' => '...', 'aria-describedby' => 'basic-icon-default-owner_id']) !!}
</div>

<button type="submit" class="btn btn-primary mr-1 data-submit">{{ $submitButtonText }}</button>
<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.cancel') }}</button>