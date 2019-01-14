@extends('layouts.app')

@section('title', 'Tipe Surat')

@section('content')
<div id="modal" class="modal">
    {{ Form::open(['url' => 'tipe-surat', 'method' => 'POST']) }}
        <div class="modal-title">Tipe Surat</div>
        <div class="modal-content">
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" name="type" autocomplete="off" required>
                    <label>Type</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-flat modal-action modal-close waves-effect waves-light">Cancel</button>
            <button type="submit" class="btn-flat modal-action waves-effect waves-light">Save</button>
        </div>
    {{ Form::close() }}
</div>

<div id="modalEdit" class="modal">
    {{ Form::open(['url' => 'tipe-surat', 'method' => 'POST']) }}
        <div class="modal-title">Tipe Surat</div>
        <div class="modal-content">
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" id="edit_type" name="type" autocomplete="off" required>
                    <label>Type</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-flat modal-action modal-close waves-effect waves-light">Cancel</button>
            <button type="submit" class="btn-flat modal-action waves-effect waves-light">Save</button>
        </div>
    {{ Form::close() }}
</div>

<div class="card material-table">
    <div class="table-header">
        <span class="table-title">Tipe Surat</span>
        <div class="actions">
            <a href="#modal" class="btn-flat modal-trigger"><i class="material-icons">add</i></a>
            <a href="javascript:void(0);" class="search-toggle waves-effect btn-flat nopadding">
                <i class="material-icons">search</i>
            </a>
        </div>
    </div>
    <table id="datatable">
        <thead>
            <tr>
                <th width="10%">No</th>
                <th width="85%">Tipe Surat</th>
                <th width="10%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($types as $type)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $type->type }}</td>
                    <td><i class="material-icons">create</i></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('script')
<script src="{{ asset('vendor/CKEditor/ckeditor.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#datatable').dataTable({
            "oLanguage": {
                "sStripClasses": "",
                "sSearch": "",
                "sSearchPlaceholder": "Enter Keyword Here",
                "sInfo": "_START_ -_END_ of _TOTAL_",
                "sLengthMenu": '<span>Rows per page:</span><select class="browser-default">' +
                    '<option value="10">10</option>' +
                    '<option value="20">20</option>' +
                    '<option value="30">30</option>' +
                    '<option value="40">40</option>' +
                    '<option value="50">50</option>' +
                    '<option value="-1">All</option>' +
                '</select></div>'
            },
            bAutoWidth: false
        });
    });
</script>
@endpush