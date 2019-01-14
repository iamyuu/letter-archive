@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
{{ Form::open(['url' => 'filter/report', 'method' => 'get', 'target' => 'blank']) }}
    <div class="card-panel">
        <div class="input-field col s3">
            <select name="month" id="month" required>
                <option disabled selected>Choose Month</option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
                <option value="6">June</option>
                <option value="7">July</option>
                <option value="8">August</option>
                <option value="9">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>
            <label>Month</label>
        </div>
        <div class="input-field col s3">
            <select name="year" id="year" required>
                <option disabled selected>Choose Year</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
            </select>
            <label>Year</label>
        </div>
        <div class="input-field col s3">
            <select name="type" id="type" required>
                <option disabled selected>Choose Type</option>
                <option value="1">ALL</option>
                <option value="2">Letter In</option>
                <option value="3">Letter Out</option>
            </select>
            <label>Type</label>
        </div>
        {{-- <div class="input-field col s2">
            <select name="to" required>
                <option disabled selected>Choose one</option>
                <option value="1">PDF</option>
                <option value="2">Print</option>
            </select>
            <label>To</label>
        </div> --}}
        <div class="col s2">
            <button id="btn-filter" class="btn waves-effect waves-light cyan">Print</button>
        </div>
        <table></table>
    </div>
{{ Form::close() }}

<div class="card material-table">
    <div class="table-header">
        <div class="actions">
            <a href="javascript:void(0);" class="search-toggle waves-effect btn-flat nopadding">
                <i class="material-icons">search</i>
            </a>
        </div>
    </div>
    <table id="datatable">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Subject</th>
                <th width="25%">Surat Masuk</th>
                <th width="25%">Surat Keluar</th>
                <th width="25%">Date</th>
            </tr>
        </thead>
        <tbody id="table">
            @foreach ($letter as $l)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $l->mail_subject }}</td>
                    <td>{{ $l->from() }}</td>
                    <td>{{ $l->to() }}</td>
                    <td>{{ $l->incoming_at->format('d, M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@push('script')
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
        // $('#btn-filter').on('click', function(e) {
        //     e.preventDefault();
        //     var type  = $('#type').val(),
        //         month = $('#month').val(),
        //         year  = $('#year').val();

        //     $.ajax({
        {{-- //         url: '{{ url('filter') }}', --}}
        //         type: 'get',
        //         data: {type: type, month: month, year: year},
        //         success: function(data) {
        //             $('#table').html(data);
        //         }
        //     });
        // });
    });
</script>
@endpush