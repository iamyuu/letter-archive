@extends('layouts.app')

@section('title', 'User')

@section('content')
<style>
    .hide{display: none;}
</style>
<div id="modal" class="modal">
    <form action="{{ route('user.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="modal-content" style="margin-bottom: 47%;">
            <div class="input-field col s12">
                <input type="text" name="name" autocomplete="off" required>
                <label>Nama</label>
            </div>
            <div class="input-field col s6">
                <input type="email" name="email" autocomplete="off" required>
                <label>Email</label>
            </div>
            <div class="input-field col s6">
                <input type="text" name="phone" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                <label>No. Tlp</label>
            </div>
            <div class="input-field col s6">
                <select name="gender">
                    <option disabled selected>Choose your option</option>
                    <option value="1">Laki - laki</option>
                    <option value="2">Perempuan</option>
                </select>
                <label>Jenis Kelamin</label>
            </div>
            <div class="input-field col s6">
                <select name="role" id="role">
                    <option disabled selected>Choose your option</option>
                    <option value="1">Seketaris</option>
                    <option value="2">Division</option>
                </select>
                <label>Jabatan</label>
            </div>
            <div class="input-field col s12 hide" id="hide-card">
                <select name="division" id="division">
                    <option disabled selected>Choose your option</option>
                    <option value="1">Graphic</option>
                    <option value="2">Programmer</option>
                </select>
                <label>Division</label>
            </div>
            <div class="input-field col s12">
                <textarea name="address" id="textarea" class="materialize-textarea"></textarea>
                <label for="textarea">Alamat</label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-flat modal-action modal-close waves-effect waves-light">Batal</button>
            <button type="submit" class="btn-flat modal-action waves-effect waves-light">Simpan</button>
        </div>
    </form>
</div>

<div id="modal-edit" class="modal">
    <form action="{{ route('user.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="modal-content" style="margin-bottom: 47%;">
            <div class="input-field col s12">
                <input type="text" name="name" id="name" autocomplete="off" required>
                <label>Nama</label>
            </div>
            <div class="input-field col s6">
                <input type="email" name="email" id="email" autocomplete="off" required>
                <label>Email</label>
            </div>
            <div class="input-field col s6">
                <input type="text" name="phone" id="phone" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                <label>No. Tlp</label>
            </div>
            <div class="input-field col s6">
                <select name="gender" id="gender">
                    <option value="1">Laki - laki</option>
                    <option value="2">Perempuan</option>
                </select>
                <label>Jenis Kelamin</label>
            </div>
            <div class="input-field col s6">
                <select name="role" id="role">
                    <option value="2">Seketaris</option>
                    <option value="1">Division</option>
                </select>
                <label>Jabatan</label>
            </div>
            <div class="input-field col s12 hide" id="hide-card">
                <select name="division" id="division">
                    <option value="1" disabled selected>Choose your option</option>
                    <option value="3">Graphic</option>
                    <option value="4">Programmer</option>
                </select>
                <label>Division</label>
            </div>
            <div class="input-field col s12">
                <textarea name="address" id="address" class="materialize-textarea"></textarea>
                <label for="address">Alamat</label>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-flat modal-action modal-close waves-effect waves-light">Batal</button>
            <button type="submit" class="btn-flat modal-action waves-effect waves-light">Simpan</button>
        </div>
    </form>
</div>

<div class="card material-table">
    <div class="table-header">
        <span class="table-title">User</span>
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
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>email</th>
                <th>No. tlp</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->gender() }}</td>
                    <td>{{ $user->address }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone }}</td>
                    <td>
                        <a href="javascript:void(0);" class="btn-flat btn-edit" data-id="{{ $user->id }}"
                            data-name="{{ $user->name }}" data-gender="{{ $user->gender }}" data-address="{{ $user->address }}"
                            data-email="{{ $user->email }}" data-phone="{{ $user->phone }}">
                            <i class="material-icons">edit</i>
                        </a>
                        {{ Form::open(['route' => ['user.destroy', $user->id], 'method' => 'DELETE']) }}
                            <button class="btn-flat">
                                <i class="material-icons">clear</i>
                            </button>
                        {{ Form::close() }}
                    </td>
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
                "sSearchPlaceholder": "Masukan Kata Di sini",
                "sInfo": "_START_ -_END_ of _TOTAL_",
                "sLengthMenu": '<span>Baris per halaman:</span><select class="browser-default">' +
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
        $('.btn-edit').on('click', function(e) {
            var id    = $(this).data('id'),
                name  = $(this).data('name'),
                gender  = $(this).data('gender'),
                address = $(this).data('address'),
                email = $(this).data('email'),
                phone = $(this).data('phone');
            $('#id').val(id);
            $('#name').val(name);
            $('#gender').val(gender).change();
            $('#gender').val(role).change();
            $('#address').val(address);
            $('#email').val(email);
            $('#phone').val(phone);
            $('#modal-edit').modal('open');
        });
        // $('.btn-delete').on('click', function(e) {
        //     swal({
        //       title: 'Yakin menghapus data?',
        //       text: "Data akan di pindahkan ke tempat sampah",
        //       type: 'warning',
        //       showCancelButton: true,
        //       confirmButtonColor: '#3085d6',
        //       cancelButtonColor: '#d33',
        //       confirmButtonText: 'Ya',
        //       cancelButtonText: 'Batal'
        //     }).then((result) => {
        //       if (result) {
        //         $('.form-delete').submit();
        //       }
        //     });
        // });
        $('#role').on('change', function() {
            if ($(this).val() == 2)
                $('#hide-card').removeClass('hide');
            else
                $('#hide-card').addClass('hide');
        });
        @if ($data = Session::get('status'))
            Materialize.toast('{{ $data }}', 2500);
        @endif
    });
</script>
@endpush