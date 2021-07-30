
<div class="form-group">
    {!! Form::label('name', __('admin.name'), ['class' => 'form-label']) !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Jhon Doe', 'aria-label' => 'Jhon Doe', 'aria-describedby' => 'basic-icon-default-fullname', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('email', __('admin.email'), ['class' => 'form-label']) !!}
    {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'john.doe@example.com', 'aria-label' => 'john.doe@example.com', 'aria-describedby' => 'basic-icon-default-email2', 'required']) !!}
    <small class="form-text text-muted"> You can use letters, numbers & periods </small>
</div>

<div class="form-group">
    {!! Form::label('phone', __('admin.phone'), ['class' => 'form-label']) !!}
    {!! Form::number('phone', null, ['class' => 'form-control', 'placeholder' => '...', 'aria-label' => '...', 'aria-describedby' => 'basic-icon-default-phone']) !!}
</div>

<div class="form-group">
    {!! Form::label('password', __('admin.password'), ['class' => 'form-label']) !!}
    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => __('admin.password')]) !!}
</div>

<div class="form-group">
    {!! Form::label('password_confirmation', __('admin.password_confirmation'), ['class' => 'form-label']) !!}
    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => __('admin.password_confirmation')]) !!}
</div>

<!-- End new -->
<!-- <div class="form-group">
    <label class="form-label" for="basic-icon-default-fullname">Full Name</label>
    <input type="text" required class="form-control dt-full-name" id="basic-icon-default-fullname"placeholder="John Doe" name="user-fullname" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2"/>
</div>

<div class="form-group">
    <label class="form-label" for="basic-icon-default-uname">Username</label>
    <input type="text" id="basic-icon-default-uname" class="form-control dt-uname" placeholder="Web Developer" aria-label="jdoe1" aria-describedby="basic-icon-default-uname2" name="user-name"/>
</div>

<div class="form-group">
    <label class="form-label" for="basic-icon-default-email">Email</label>
    <input type="text" id="basic-icon-default-email" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" aria-describedby="basic-icon-default-email2" name="user-email"/>
    <small class="form-text text-muted"> You can use letters, numbers & periods </small>
</div>

<div class="form-group">
    <label class="form-label" for="user-role">User Role</label>
    <select id="user-role" class="form-control">
        <option value="subscriber">Subscriber</option>
        <option value="editor">Editor</option>
        <option value="maintainer">Maintainer</option>
        <option value="author">Author</option>
        <option value="admin">Admin</option>
    </select>
</div>

<div class="form-group mb-2">
    <label class="form-label" for="user-plan">Select Plan</label>
    <select id="user-plan" class="form-control">
        <option value="basic">Basic</option>
        <option value="enterprise">Enterprise</option>
        <option value="company">Company</option>
        <option value="team">Team</option>
    </select>
</div> -->

<button type="submit" class="btn btn-primary mr-1 data-submit">{{ $submitButtonText }}</button>
<button type="reset" class="btn btn-outline-secondary" data-dismiss="modal">{{ __('admin.cancel') }}</button>