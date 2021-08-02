@isset($buttons)
<div class="btn-group">

    <a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">
        <svg xmlns="http://www.w3.org/2000/svg" style="width:14px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
        </svg>
    </a>

    <div class="dropdown-menu dropdown-menu-right">
        @foreach($buttons as $index => $button)
            @switch($button)
                @case('show')
                <a href="{{ route($routeName.'.show', $id) }}" class="dropdown-item btn-show">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:15px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    {{ __('admin.details') }}
                </a>
                @break
                @case('edit')
                <a href="{{ route($routeName.'.edit', $id) }}" class="dropdown-item btn-edit">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width:15px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    {{ __('admin.edit') }}
                </a>
                @break
                @case('delete')
                    {!! Form::open([
                        'class'                => 'table-form-action',
                        'data-confirm-title'   => __('admin.confirm_delete_title'),
                        'data-confirm-message' => __('admin.confirm_delete_message'),
                        'data-confirm-button'  => __('admin.delete'),
                        'data-success-title'   => __('admin.success'),
                        'data-success-message' => __('admin.success_message_delete'),
                        'method'               => 'DELETE', 
                        'url'                  => route($routeName.'.destroy', $id)]) !!}

                        <a class="dropdown-item btn-delete">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:15px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            {{ __('admin.delete') }}
                        </a>
                    {!! Form::close() !!}
                @break
                @case('restore')
                    {!! Form::open([
                        'class'                => 'table-form-action',
                        'data-confirm-title'   => __('admin.confirm_restore_title'),
                        'data-confirm-message' => __('admin.confirm_restore_message'),
                        'data-confirm-button'  => __('admin.restore'),
                        'data-success-title'   => __('admin.success'),
                        'data-success-message' => __('admin.success_message_restore'),
                        'method'               => 'POST', 
                        'url'                  => route($routeName.'.restore', $id)]) !!}
                        <a class="dropdown-item btn-restore">
                            <svg xmlns="http://www.w3.org/2000/svg" style="width:15px" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                            </svg>
                            {{ __('admin.restore') }}
                        </a>
                    {!! Form::close() !!}
                @break
            @endswitch
        @endforeach
    </div>
</div>
@endif