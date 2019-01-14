@extends('layouts.app')

@section('title', "$letter->id")

@section('content')
@if (Auth::id() == 2)
    <div id="modal" class="modal">
        <form action="">
            <div class="modal-title">{{ $letter->id }}</div>
            <div class="modal-content">
                <div class="row">
                    <div class="input-field col s4">
                        <input type="text" autocomplete="off" required value="{{ $letter->mail_code }}">
                        <label>Letter Code</label>
                    </div>
                    <div class="input-field col s4">
                        <input type="date" class="datepicker" required value="{{ $letter->incoming_at->format('Y-m-d') }}">
                        <label>Incoming At</label>
                    </div>
                    <div class="input-field col s4">
                        <input type="text" autocomplete="off" required value="{{ $letter->mail_from }}">
                        <label>From</label>
                    </div>
                    <div class="input-field col s12">
                        <input type="text" autocomplete="off" required value="{{ $letter->mail_subject }}">
                        <label>Subject</label>
                    </div>
                    <div class="input-field col s12">
                        <textarea name="content" class="materialize-textarea">{{ $letter->mail_content }}</textarea>
                        <label>Content</label>
                    </div>
                    {{-- <div class="file-field input-field col s12">
                        <div class="btn blue darkend-1">
                            <span>File</span>
                            <input type="file" multiple>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path" type="text" placeholder="Upload one or more files" value="{{ $files[0] }}">
                            <img src="{{ asset('path') }}" alt="">
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-flat modal-action modal-close waves-effect waves-light">Cancel</button>
                <button type="submit" class="btn-flat modal-action waves-effect waves-light">Save</button>
            </div>
        </form>
    </div>
@endif

<div class="card-panel y-card">
    <div class="header">
        <span class="y-title">{{ $letter->mail_subject }}</span>
        <div class="action">
            @if (Auth::id() == 2)
                {{-- <a href="#modal" class="btn-flat modal-trigger"><i class="material-icons">edit</i></a> --}}
            @endif
                <a href="javascript:void(0);" style="color: black;" id="btn-print"><i class="material-icons">print</i></a>
        </div>
    </div>
    <div class="content"> <br>
        <span class="right">{{ $letter->incoming_at->format('d, M Y') }}</span> <br><br>
        {!! $letter->mail_content !!}
    </div> <br>
    <table class="bordered">
        <thead>
            <tr>
                <td width="90%"><h5>File</h5></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @forelse ($files as $file)
                <tr>
                    <td>{{ $file->name }}</td>
                    <td>
                        <a href="{{ asset("$file->file") }}" download>
                            <i class="material-icons">file_download</i>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="center">Nothing file in attachment</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@push('script')
<script src="{{ asset('vendor/CKEditor/ckeditor.js') }}"></script>
<script>
@if (Auth::user()->role_id == 2)
    CKEDITOR.replace('content', {
        enterMode: CKEDITOR.ENTER_BR
    });
@endif
    $('#btn-print').on('click', function(e) {
        e.preventDefault();
        var link = '{{ url('print-surat', Crypt::encrypt($letter->id)) }}';
        window.open(link);
    });
@if (Auth::user()->role_id > 2)
    setInterval(function() {
        $.ajax({
            url: '{{ url('count.unread') }}',
            type: 'get',
            success: function(data) {
                $('#notif').addClass('new badge cyan');
                $('#notif').html(data);
                if (data == 0) {
                    $('#notif').removeClass('new badge cyan');
                    $('#notif').html('');
                }
            }
        });
    }, 250);
@endif
</script>
@endpush
