
<div class="form-group">
    {!! Form::label('client_id', __('admin.client_id'), ['class' => 'form-label']) !!}
    {!! Form::text('client_id', null, ['class' => 'form-control', 'placeholder' => 'Jhon Doe', 'aria-label' => 'admin.permission', 'aria-describedby' => 'basic-icon-default-fullclient_id', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('formula', __('admin.formula'), ['class' => 'form-formula']) !!}
    {!! Form::text('formula', null, ['class' => 'form-control', 'placeholder' => 'Permission formula', 'aria-describedby' => 'basic-icon-default-formula2', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('apply_date', __('admin.apply_date'), ['class' => 'form-label']) !!}
    {!! Form::date('apply_date', null, ['class' => 'form-control', 'placeholder' => '...', 'aria-label' => '...', 'aria-describedby' => 'basic-icon-default-apply_date']) !!}
</div>

<div class="form-group">
    {!! Form::label('redken_products', __('admin.redken_products'), ['class' => 'form-redken_products']) !!}
    {!! Form::text('redken_products', null, ['class' => 'form-control', 'placeholder' => '...', 'aria-label' => '...', 'aria-describedby' => 'basic-icon-default-redken_products']) !!}
</div>

<div class="form-group">
    {!! Form::label('loreal_products', __('admin.loreal_products'), ['class' => 'form-loreal_products']) !!}
    {!! Form::number('loreal_products', null, ['class' => 'form-control', 'placeholder' => '...', 'aria-label' => '...', 'aria-describedby' => 'basic-icon-default-loreal_products']) !!}
</div>

<div class="form-group">
    {!! Form::label('kerestase_products', __('admin.kerestase_products'), ['class' => 'form-kerestase_products']) !!}
    {!! Form::number('kerestase_products', null, ['class' => 'form-control', 'placeholder' => '...', 'aria-label' => '...', 'aria-describedby' => 'basic-icon-default-kerestase_products']) !!}
</div>

<div class="form-group">
    {!! Form::label('treatments', __('admin.treatments'), ['class' => 'form-treatments']) !!}
    {!! Form::number('treatments', null, ['class' => 'form-control', 'placeholder' => '...', 'aria-label' => '...', 'aria-describedby' => 'basic-icon-default-treatments']) !!}
</div>

<button type="submit" class="btn btn-primary mr-1 data-submit">{{ $submitButtonText }}</button>
<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.cancel') }}</button>