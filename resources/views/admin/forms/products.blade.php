
<div class="form-group">
    {!! Form::label('name', __('admin.name'), ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Jhon Doe', 'aria-label' => 'admin.permission', 'aria-describedby' => 'basic-icon-default-fullname', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('brand_id', __('admin.brand_id'), ['class' => 'form-brand_id']) !!}
    {!! Form::number('brand_id', null, ['class' => 'form-control', 'placeholder' => 'Permission brand_id', 'aria-describedby' => 'basic-icon-default-brand_id2', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('url_image', __('admin.url_image'), ['class' => 'form-label']) !!}
    {!! Form::tel('url_image', null, ['class' => 'form-control', 'placeholder' => '...', 'aria-label' => '...', 'aria-describedby' => 'basic-icon-default-url_image']) !!}
</div>

<button type="submit" class="btn btn-primary mr-1 data-submit">{{ $submitButtonText }}</button>
<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.cancel') }}</button>