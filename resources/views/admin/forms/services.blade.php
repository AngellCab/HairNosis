<div class="form-group">
    {!! Form::label('stylist', __('admin.stylist'), ['class' => 'form-label']) !!}
    {!! Form::select('stylist_helpers[]', $stylists, isset($stylist_helpers) ? $stylist_helpers : null, ['class' => 'form-control select2', 'multiple', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('client', __('admin.client'), ['class' => 'form-label']) !!}
    {!! Form::select('client_id', $clients, null, ['class' => 'form-control select2', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('formula', __('admin.formula'), ['class' => 'form-label']) !!}
    {!! Form::textarea('formula', null, ['class' => 'form-control', 'placeholder' => 'formula', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('apply_date', __('admin.apply_date'), ['class' => 'form-label']) !!}
    {!! Form::date('apply_date', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('redken_products', __('admin.redken_products'), ['class' => 'form-label']) !!}
    {!! Form::select('redken_products[]', $redken, null, ['class' => 'form-control select2', 'multiple']) !!}
</div>

<div class="form-group">
    {!! Form::label('loreal_products', __('admin.loreal_products'), ['class' => 'form-label']) !!}
    {!! Form::select('loreal_products[]', $loreal, null, ['class' => 'form-control select2', 'multiple']) !!}
</div>

<div class="form-group">
    {!! Form::label('kerestase_products', __('admin.kerestase_products'), ['class' => 'form-label']) !!}
    {!! Form::select('kerestase_products[]', $kerestase, null, ['class' => 'form-control select2', 'multiple']) !!}
</div>

<div class="form-group">
    {!! Form::label('treatments', __('admin.treatments'), ['class' => 'form-label']) !!}
    {!! Form::select('treatments', $treatments, null, ['class' => 'form-control select2', 'multiple']) !!}
</div>

<button type="submit" class="btn btn-primary mr-1 data-submit">{{ $submitButtonText }}</button>
<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.cancel') }}</button>

<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>