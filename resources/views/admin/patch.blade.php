<div class="w-100">
    @if ($formAction == 'create')
        <h5 class="text-xl mt-2 font-medium mb-1 w-10/12">{{ __('admin.new_record') }}</h5>
    @else
        <h5 class="text-xl mt-2 font-medium mb-1 w-10/12">Editando: <strong>{{ $formModel->name_es }}</strong></h5>
    @endif

    <p class="text-sm">Llena todos los campos requeridos para continuar</p>

    @if ($formAction == 'create')

        {{-- On create new resource --}}

        {!! Form::open(['data-remote', 
            'url'                         => route($routeName.'.store'),
            'data-remote-confirm-title'   => __('admin.confirm_save_title'),
            'data-remote-confirm-message' => __('admin.confirm_save_message'),
            'data-remote-confirm-button'  => __('admin.save'),
            'data-remote-success-title'   => __('admin.success'),
            'data-remote-success-message' => __('admin.success_message_save'),
            "files" => true, "enctype"    => "multipart/form-data"]) !!}

        @include('admin.forms.'.$routeName, ['submitButtonText' => __('admin.save'), 'cancelButtonText' => __('admin.cancel')])
    @else

        {{-- On update element --}}

        {!! Form::model( $formModel, ['data-remote',
            'data-remote-confirm-title'   => __('admin.confirm_update_title'),
            'data-remote-confirm-message' => __('admin.confirm_update_message'),
            'data-remote-confirm-button'  => __('admin.save'),
            'data-remote-success-title'   => __('admin.success'),
            'data-remote-success-message' => __('admin.success_message_update'),
            'method' => 'PATCH', 'url' => $url, "files" => true, "enctype"    => "multipart/form-data"]) !!}

        @include('admin.forms.'.$routeName, ['submitButtonText' => __('admin.update'), 'cancelButtonText' => __('admin.cancel')])
    @endif

    {!! Form::close() !!}
</div>

<script>
    $.confirmSubmitAjaxForm();
</script>
