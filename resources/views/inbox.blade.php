@extends('layouts.app')

@section('title', 'Inbox')

@section('content')
<div class="card material-table">
    <div class="table-header">
        <span class="table-title">Inbox</span>
        <div class="actions">
            <a href="{{ url('inbox') }}">Reload</a>
            <a href="javascript:void(0);" class="search-toggle waves-effect btn-flat nopadding">
                <i class="material-icons">search</i>
            </a>
        </div>
    </div>
    
    <div class="row">
        <table id="datatable">
            <thead>
                <tr>
                    <th width="10%">Subject</th>
                    <th width="75%">Content</th>
                    <th width="15%">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($letters as $letter)
                @if ($letter->read_unread == 0)
                    <tr style="background-color: #eee;">
                @else
                    <tr>
                @endif
                        <td>{{ str_limit($letter->mail->mail_subject, 25) }}</td>
                        <td>
                            <a href="{{ url('detail-surat', Crypt::encrypt($letter->mail->id)) }}">
                                {!! str_limit($letter->mail->mail_content, 115) !!}
                            </a>
                        </td>
                        <td>{{ $letter->mail->mail_date->format('d, M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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