{{-- alert success --}}   
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p><strong><i class="fa-solid fa-circle-check"></i></strong> {{ $message }}</p>
</div>
@endif

{{-- alert fail --}}   
@if ($message = Session::get('fail'))
<div class="alert alert-danger">
    <p><strong><i class="fa-solid fa-circle-xmark"></i></strong> {{ $message }}</p>
</div>
@endif

{{-- alerts errors --}}
@if (isset($errors) && $errors->any())
    <div class="alert alert-danger">
        <strong><i class="fa-solid fa-triangle-exclamation"></i> Error!</strong> Harap diperhatikan.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- display error import --}}
@if (session()->has('failures'))
<table class="table table-warning">
    <tr>
        <th>Baris</th>
        <th>Atribut</th>
        <th>Error</th>
        <th>Value</th>
    </tr>
    @foreach (session()->get('failures') as $validation)
        <tr>
            <td>{{ $validation->row() }}</td>
            <td>{{ $validation->attribute() }}</td>
            <td>
                <ul>
                    @foreach ($validation->errors() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </td>
            <td>{{ $validation->values()[$validation->attribute()] }}</td>
        </tr>
    @endforeach
</table>
@endif