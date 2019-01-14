@extends('layouts.app')

@section('title', 'Surat Masuk')

@section('style')
<style>
    #cke_1_bottom {display: none;}
</style>
@endsection

@section('content')
<div id="modal" class="modal">
    {{ Form::open(['url' => 'suratmasuk', 'method' => 'POST', 'files' => true]) }}
        <div class="modal-title id"></div>
        <div class="modal-content">
            <div class="row">
                <input type="hidden" name="id" id="kode">
                <div class="input-field col s4">
                    <input type="text" name="code" value="{{ mt_rand(001, 999).'/LTR/'.date('Y') }}" autocomplete="off" required>
                    <label>Letter Code</label>
                </div>
                <div class="input-field col s4">
                    <input type="date" name="incoming" class="datepicker" required>
                    <label>Incoming At</label>
                </div>
                <div class="input-field col s4">
                    <input type="text" name="to" autocomplete="off" required>
                    <label>To</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" name="subject" autocomplete="off" required>
                    <label>Subject</label>
                </div>
                <div class="input-field col s12">
                    <textarea name="content" class="materialize-textarea"></textarea>
                    {{-- <label>Content</label> --}}
                </div>
                <div class="file-field input-field col s12">
                    <div class="btn">
                        <span>File</span>
                        <input type="file">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path" type="text">
                    </div>
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
        <span class="table-title">Letter Out</span>
        <div class="actions">
            <a href="#modal" class="btn-flat modal-trigger"><i class="material-icons">add</i></a>
            <a href="javascript:void(0);" class="search-toggle waves-effect btn-flat nopadding">
                <i class="material-icons">search</i>
            </a>
        </div>
    </div>
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            {!! $error !!}
        @endforeach
    @endif
    <table id="datatable">
        <thead>
            <tr>
                <th width="10%">Subject</th>
                <th width="65%">Content</th>
                <th width="10%"></th>
                <th width="15%">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($letters as $letter)
                <tr>
                    <td>{{ str_limit($letter->mail_subject, 25) }}</td>
                    <td>
                        <a href="{{ url('lihat-surat', Crypt::encrypt($letter->id)) }}">
                            {!! str_limit($letter->mail_content, 115) !!}
                        </a>
                    </td>
                    <td>
                        <a href="javascript:void(0);" class="forward" data-id="{{ $letter->id }}">
                            <i class="fa fa-mail-forward"></i>
                        </a>
                    </td>
                    <td>{{ $letter->incoming_at->format('d, M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('script')
<script src="{{ asset('vendor/CKEditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('content', {
        enterMode: CKEDITOR.ENTER_BR
    });
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
        $.get('{{ url('mail.id') }}', function(data) {
            var kode = "#LTR",
                no = parseInt(data.no) + 1;

            if (no < 10) {
                kode += "0000" + no;
            } else if (no < 100) {
                kode += "000" + no;
            } else if (no < 1000) {
                kode += "00" + no;
            } else if (no < 10000) {
                kode += "0" + no;
            } else {
                kode += "00001";
            }

            $('#kode').val(kode);
            $('.id').html(kode);

            // console.log('id ' + kode);
        });
        @if (Session::has('success'))
            Materialize.toast({{ Session::get('success') }}, 2000);
        @endif
    });
</script>
@endpush