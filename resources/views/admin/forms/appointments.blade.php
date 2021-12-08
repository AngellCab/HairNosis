<div class="form-group">
    {!! Form::label('client_id', __('admin.client'), ['class' => 'form-label']) !!}
    {!! Form::select('client_id', $clients, null, ['class' => 'form-control select2']) !!}
</div>

<div class="form-group">
    {!! Form::label('location_id',  __('admin.location'), ['class' => 'form-label']) !!}
    {!! Form::select('location_id', $locations, null,    ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('apply_date', __('admin.apply_date'), ['class' => 'form-label']) !!}
    {!! Form::date('apply_date', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('hour', __('admin.hour'), ['class' => 'form-label']) !!}
    {!! Form::time('hour', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('appointment_reason', __('admin.appointment_reason'), ['class' => 'form-label']) !!}
    {!! Form::textArea('appointment_reason', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('status', __('admin.status'), ['class' => 'form-label']) !!}
    {!! Form::select('status', $status, null, ['class' => 'form-control']) !!}
</div>

<button type="submit" class="btn btn-primary mr-1 data-submit">{{ $submitButtonText }}</button>
<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.cancel') }}</button>