@extends('layout.master')
@section('content')
<a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">
    <i class="fa fa-plus"></i> Tambah
</button>
<table class="table table-striped" id="datatable-user">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Role</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
          <tr>
            <td scope="row">{{ $loop->index + 1 }}</td>
            <td>{{ $user->role }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>
              @if (auth()->user()->id != $user->id)
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                onclick="setData('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}')">
                <i class="fa fa-edit"></i> Ubah
              </button>
              <form action="/user" method="post" class="d-inline">
                @csrf
                @method('delete')
                <input type="hidden" name="id" value="{{ $user->id }}">
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
              </form>
              @else
              <p class="text-muted">tidak diizinkan</p>
              @endif
            </td>
          </tr>
      @endforeach
    </tbody>
  </table>

  {{ $users->links() }}

  <!-- tambah Modal -->
  <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/user" method="post" id="tambahForm">
            @csrf
            <div class="mb-3">
              <label>Role</label>
              <select name="role" class="form-control">
                <option value="ktu">KTU</option>
                <option value="staff_ppic">Staff PPIC</option>
                <option value="krani_ppic">Krani PPIC</option>
                <option value="kepala_gudang">Kepala Gudang</option>
                <option value="krani_gudang">Krani Gudang</option>
              </select>
            </div>
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Full Name" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
                <div class="form-text">abaikan jika tidak ingin diubah.</div>
            </div>
            <div class="mb-3">
                <label>Password Confirmation</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Password confirmation" required>
                <div class="form-text">abaikan jika tidak ingin diubah.</div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="tambahForm" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <!-- ubah Modal -->
  <div class="modal fade" id="ubahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ubahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="ubahModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/user" method="post" id="ubahForm">
            @csrf
            @method('put')
            <input type="hidden" name="id" id="ubahID">
            <div class="mb-3">
              <label>Role</label>
              <select name="role" class="form-control" id="ubahRole" required>
                <option value="ktu">KTU</option>
                <option value="staff_ppic">Staff PPIC</option>
                <option value="krani_ppic">Krani PPIC</option>
                <option value="kepala_gudang">Kepala Gudang</option>
                <option value="krani_gudang">Krani Gudang</option>
              </select>
            </div>
            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Full Name" id="ubahName" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" id="ubahEmail" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Password">
                <div class="form-text">abaikan jika tidak ingin diubah.</div>
            </div>
            <div class="mb-3">
                <label>Password Confirmation</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Password confirmation">
                <div class="form-text">abaikan jika tidak ingin diubah.</div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="ubahForm" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    function setData(id, name, email) {
      ubahID.value= id;
      ubahName.value = name;
      ubahEmail.value = email;
    }
  </script>
@endsection