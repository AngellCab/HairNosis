
<div class="form-group">
    {!! Form::label('name', __('admin.name'), ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Jhon Doe', 'aria-label' => 'admin.permission', 'aria-describedby' => 'basic-icon-default-fullname', 'required']) !!}
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
    {!! Form::label('location_id', __('admin.owner_id'), ['class' => 'form-location_id']) !!}
    {!! Form::number('location_id', null, ['class' => 'form-control', 'placeholder' => '...', 'aria-label' => '...', 'aria-describedby' => 'basic-icon-default-location_id']) !!}
</div>

<div class="form-group">
    {!! Form::label('stylist_id', __('admin.owner_id'), ['class' => 'form-stylist_id']) !!}
    {!! Form::number('stylist_id', null, ['class' => 'form-control', 'placeholder' => '...', 'aria-label' => '...', 'aria-describedby' => 'basic-icon-default-stylist_id']) !!}
</div>

<button type="submit" class="btn btn-primary mr-1 data-submit">{{ $submitButtonText }}</button>
<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.cancel') }}</button>