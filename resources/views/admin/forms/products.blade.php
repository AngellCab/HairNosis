
<div class="form-group">
    {!! Form::label('name', __('admin.name'), ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('brand_id', __('admin.brand'), ['class' => 'form-label']) !!}
    {!! Form::select('brand_id', [1 =>  'N/A', 2 => 'Redken', 3 => 'Loreal', 4 => 'Kerestase'], null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('url_image', __('admin.image'), ['class' => 'form-label']) !!}
    {!! Form::tel('url_image', null, ['class' => 'form-control']) !!}
</div>

<button type="submit" class="btn btn-primary mr-1 data-submit">{{ $submitButtonText }}</button>
<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.cancel') }}</button>