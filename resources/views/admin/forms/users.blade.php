
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

<div class="form-group">
    {!! Form::label('password', __('admin.password'), ['class' => 'form-label']) !!}
    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => __('admin.password'), 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('password_confirmation', __('admin.password_confirmation'), ['class' => 'form-label']) !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => __('admin.password_confirmation'), 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('role_list', __('admin.role')) !!}
    {!! Form::select('role_list[]', $roles, null, ['id' => 'role_list', 'class' => 'form-control select2', 'multiple']) !!}
</div>

<hr/>
<h4>{{ __('messages.create_company') }}</h4>

<div class="form-group">
    {!! Form::label('name_company', __('admin.name_company'), ['class' => 'form-label']) !!}
    {!! Form::text('name_company', null, ['class' => 'form-control', 'placeholder' => __('admin.name_company'), 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('address', __('admin.address'), ['class' => 'form-label']) !!}
    {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => __('admin.address')]) !!}
</div>

<div class="form-group">
    {!! Form::label('phone_company', __('admin.phone_company'), ['class' => 'form-label']) !!}
    {!! Form::tel('phone_company', null, ['class' => 'form-control', 'placeholder' => __('admin.phone_company')]) !!}
</div>

<div class="form-group">
    {!! Form::label('email_company', __('admin.email_company'), ['class' => 'form-label']) !!}
    {!! Form::email('email_company', null, ['class' => 'form-control', 'placeholder' => __('admin.email_company')]) !!}
</div>


<button type="submit" class="btn btn-primary mr-1 data-submit">{{ $submitButtonText }}</button>
<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.cancel') }}</button>

<script type="text/javascript">
    $(document).ready(function () {
        $('.select2').select2();
    });
</script>