{{-- <link rel="stylesheet" href="{{ asset('vendor/materialize/css/materialize.min.css') }}"> --}}
@if ($forwards->isEmpty())
	{{ Form::open(['url' => 'forward', 'method' => 'POST', 'files' => true]) }}
	    <div class="modal-content">
            <div class="col s4">
                <input type="radio" name="status" class="with-gap" value="1" id="ordinary">
                <label for="ordinary">Biasa</label>
            </div>
            <div class="col s4">
                <input type="radio" name="status" class="with-gap" value="3" id="secret">
                <label for="secret">Rahasia</label>
            </div>
            <div class="col s4">
                <input type="radio" name="status" class="with-gap" value="2" id="important">
                <label for="important">Penting</label>
            </div>
            <p class="col s6">
                <input type="checkbox" id="design" name="to[]" value="3">
                <label for="design">Division Design</label>
            </p>
            <p class="col s6">
                <input type="checkbox" id="proggramer" name="to[]" value="4">
                <label for="proggramer">Division Proggramer</label>
            </p>
{{--             <div class="input-field col s12" style="padding-bottom: 100px;">
                <select name="to" multiple>
                    <option disabled selected>Choose your option</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->role }}</option>
                    @endforeach
                </select>
                <label>Disposition To</label>
            </div> --}}
            <div class="input-field col s12">
                <textarea name="description"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <input  type="hidden" name="id" value="{{ $id }}">
            <button type="button" class="btn-flat modal-action modal-close waves-effect waves-light">Cancel</button>
            <button type="submit" class="btn-flat modal-action waves-effect waves-light">Save</button>
        </div>
	{{ Form::close() }}
@else
	<div class="modal-content">
		<table class="table">
			<thead>
				<tr>
					<td>No</td>
					<td>To</td>
					<td>Date</td>
				</tr>
			</thead>
			<tbody>
				@foreach($forwards as $forward)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $forward->user->role }}</td>
						<td>{{ $forward->disposition_at->format('d, M Y') }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<div class="modal-footer">
        <button type="button" class="btn-flat modal-action modal-close waves-effect waves-light">Cancel</button>
        <button type="submit" class="btn-flat modal-action waves-effect waves-light">Save</button>
    </div>
@endif

{{-- <script src="{{ asset('vendor/materialize/js/materialize.min.js') }}"></script> --}}
<script src="{{ asset('vendor/CKEditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('description', {
        enterMode: CKEDITOR.ENTER_BR
    });
</script>