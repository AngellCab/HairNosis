@extends('layouts/contentLayoutMaster')

@section('title', __($title))

@section('vendor-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap4.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/buttons.bootstrap4.min.css')) }}">
@endsection

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-user.css')) }}">
@endsection

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@section('content')

<!-- filters area -->
@if(isset($filters))
    <div class="card">
        <h5 class="card-header">Search Filter</h5>
        <div class="d-flex justify-content-between align-items-center mx-50 row pt-0 pb-2 filter-area">
            @foreach($filters as $index => $filter)
                <div class="{{ $filter['width'] }}">
                    {!! Form::select($filter['idname'], $filter['listArray'], null, ['id' => $filter['idname'], 
                        'class' => 'form-control text-capitalize mb-md-0 mb-2xx', isset($filter['data']) ? $filter['data'] : '',
                        'placeholder' => 'Select role']) !!}
                </div>
            @endforeach
        </div>
    </div>
@endif
<!-- filters area end -->

<!-- list section start -->
<div class="card">
    <div class="card-datatable table-responsive pt-0">
        <table class="user-list-table table" data-datatable="true">
            <thead class="thead-light">
                <tr>
                @foreach($columnHeaders as $header)
                    <th>{{ $header }}</th>
                @endforeach
                </tr>
            </thead>
        </table>
    </div>
</div>
<!-- list section end -->

<!-- Modal to add new user starts-->
<div class="modal modal-slide-in new-user-modal fade" id="modals-slide-in">
    <div class="modal-dialog">
            <div class="modal-content pt-0">
        <!-- <form class="add-new-user modal-content pt-0"> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">??</button>
            <div class="modal-header mb-1">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('messages.new_record') }}</h5>
            </div>
          
            <div class="modal-body flex-grow-1" id="form-area"></div>
        </div>
        <!-- </form> -->
    </div>
</div>
<!-- Modal to add new user Ends-->

<!-- Modal to add new services -->
<div class="modal fade" tabindex="-1" id="exampleModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <a type="button" class="close" data-dismiss="modal" aria-label="Close">x</a>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>


<!-- Modal to add new services End -->

@endsection

@section('vendor-script')
  {{-- Vendor js files --}}
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap4.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.bootstrap4.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
@endsection

@section('page-script')
    {{-- Page js files --}}
    <!-- <script src="{{ asset(mix('js/scripts/pages/app-user-list.js')) }}"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset(mix('js/core/table.js')) }}"></script>
    <script type="application/javascript">
        
        document.addEventListener('DOMContentLoaded', function () { 
            // Table Columns
            columns = [
                @foreach($columnArray as $column)
                    {!! $column !!}
                @endforeach
            ];

            @if (!isset($data['orderstring']) && !empty($orderstring))
                order = {!! $orderstring !!};
            @else
                order = [[0, 'asc']]
            @endif

            const routeName = '{!! $routeName !!}'

            //Route to see Data
            ajax = {
                url: '{!! route('datatables.resource') !!}',
                data: function (d) {
                    d.routeName = '{!! $routeName !!}';
                    d.prefix    = '{!! $prefix !!}';
                    @if(isset($filters))
                        @foreach($filters as $filter)
                            {!! $filter['datacall'] !!}
                        @endforeach
                    @endif
                }
            };

            @if ($routeName == 'users')
                $.userDataTable(ajax, routeName ,columns, order, 'en')
            @else
                $.dataTable(ajax, routeName, columns, order, 'en')
            @endif

            $.bindActionButtons()

            @if(isset($filters))
                @foreach($filters as $filter)
                    $('select#{!! $filter['idname'] !!}').change(function () {

                        simpleTable.ajax.reload();
                        if (typeof trashTable === 'undefined') {
                        } else {
                            trashTable.ajax.reload();
                        }
                    })
                @endforeach
            @endif

            $('#exampleModal').modal('show')
        })

    </script>
@endsection