@extends('layouts.app')

@section('title', 'Arsip Surat')

@section('style')
<style>
    #cke_1_bottom {display: none;}
</style>
@endsection

@section('content')
<div id="modal" class="modal">
    {{ Form::open(['url' => 'arsip', 'method' => 'POST', 'files' => true]) }}
        <div class="modal-title id"></div>
        <div class="modal-content">
            <div class="row">
                <input type="hidden" name="id" id="kode">
                <div class="input-field col s6">
                    <input type="text" name="code" value="{{ mt_rand(001, 999).'/LTR/'.date('Y') }}" autocomplete="off" required>
                    <label>Letter Code</label>
                </div>
                <div class="input-field col s6">
                    <input type="date" name="incoming" id="incoming" class="datepicker" required>
                    <label>Incoming At</label>
                </div>
                <div class="input-field col  s12">
                    <select name="in_out" id="in_out" required>
                        <option disabled selected>Choose type letter</option>
                        <option value="1">Masuk</option>
                        <option value="2">Keluar</option>
                    </select>
                </div>
                <div class="input-field col s6">
                    <input type="text" id="from" name="from" autocomplete="off" required disabled>
                    <label>From</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" id="to" name="to" autocomplete="off" required disabled>
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
                        <input type="file" name="files">
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

<div id="modal-forward" class="modal">
    <div class="modal-title">Disposition</div>
    <div id="forward-modal-content"></div>
</div>

<div class="card material-table">
    <div class="table-header">
        <span class="table-title">Letter</span>
        <div class="actions">
            <a href="#modal" class="btn-flat modal-trigger"><i class="material-icons">add</i></a>
            <a href="javascript:void(0);" class="search-toggle waves-effect btn-flat nopadding">
                <i class="material-icons">search</i>
            </a>
        </div>
    </div>
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            {!! $error !!} <br>
        @endforeach
    @endif
    <table id="datatable">
        <thead>
            <tr>
                <th width="10%">Subject</th>
                <th width="65%">Content</th>
                <th width="10%"></th>
                <th width="15%">Date</th>
                <th width="10%">Type</th>
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
                    @if ($letter->in_out == 1)
                        <td>
                            <a href="javascript:void(0);" class="forward" data-id="{{ $letter->id }}">
                                <i class="fa fa-mail-forward"></i>
                            </a>
                        </td>
                    @else
                        <td></td>
                    @endif
                    <td>{{ $letter->incoming_at->format('d, M Y') }}</td>
                    <td>{{ $letter->in_out() }}</td>
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
        // Materialize.toast('Click content to show detail a letter', 2000);
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
        $('.forward').on('click', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            console.log(id);
            $.ajax({
                url: '{{ url('check') }}',
                data: {id: id},
                type: 'get',
                success: function(data) {
                    console.log(data);
                    $('#forward-modal-content').html(data);
                }
            });
            $('#modal-forward').modal('open');
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
        $('#in_out').on('change', function() {
            if ($(this).val() == 1) {
                $('#to').val('');
                $('#to').attr('disabled', '');
                $('#from').removeAttr('disabled', '');
                $('#incoming').removeAttr('disabled', '');
            } else if ($(this).val() == 2) {
                $('#from').val('');
                $('#from').attr('disabled', '');
                $('#to').removeAttr('disabled', '');
                $('#incoming').val(' {{ date('Y-m-d') }} ');
                $('#incoming').attr('disabled', '');
            }
        });
        @if (Session::has('success'))
            Materialize.toast({{ Session::get('success') }}, 2000);
        @endif
    });
</script>
@endpush