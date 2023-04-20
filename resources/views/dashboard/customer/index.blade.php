@extends('layout.master')
@section('content')
<a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
@if (auth()->user()->role == 'ktu')
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">
    <i class="fa fa-plus"></i> Tambah
</button>
@endif
<table class="table table-striped" id="datatable">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nama</th>
        <th scope="col">Email</th>
        <th scope="col">No Telp</th>
        <th scope="col">Alamat</th>
        @if (auth()->user()->role == 'ktu')
        <th scope="col">Action</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach ($customers as $customer)
          <tr>
            <td scope="row">{{ $loop->index + 1 }}</td>
            <td>{{ $customer->nama }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->no_telp }}</td>
            <td>{{ $customer->alamat }}</td>
            @if (auth()->user()->role == 'ktu')
            <td>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                onclick="setData('{{ $customer->id }}', '{{ $customer->nama }}', '{{ $customer->email }}', '{{ $customer->no_telp }}', '{{ $customer->alamat }}')">
                <i class="fa fa-edit"></i> Ubah
              </button>
              <form action="/customer" method="post" class="d-inline">
                @csrf
                @method('delete')
                <input type="hidden" name="id" value="{{ $customer->id }}">
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </td>
            @endif
          </tr>
      @endforeach
    </tbody>
  </table>

  {{ $customers->links() }}

  <!-- tambah Modal -->
  <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/customer" method="post" id="tambahForm">
            @csrf
            <div class="mb-3">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control">
            </div>
            <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control">
            </div>
            <div class="mb-3">
              <label>No Telp</label>
              <input type="number" name="no_telp" class="form-control">
            </div>
            <div class="mb-3">
              <label>Alamat</label>
              <textarea name="alamat" class="form-control"></textarea>
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
          <form action="/customer" method="post" id="ubahForm">
            @csrf
            @method('put')
            <input type="hidden" name="id" id="ubahID">
            <div class="mb-3">
              <label>Nama</label>
              <input type="text" name="nama" class="form-control" id="ubahNama">
            </div>
            <div class="mb-3">
              <label>Email</label>
              <input type="email" name="email" class="form-control" id="ubahEmail">
            </div>
            <div class="mb-3">
              <label>No Telp</label>
              <input type="number" name="no_telp" class="form-control" id="ubahNoTelp">
            </div>
            <div class="mb-3">
              <label>Alamat</label>
              <textarea name="alamat" class="form-control" id="ubahAlamat"></textarea>
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
    function setData(id, nama, email, no_telp, alamat) {
      ubahID.value= id;
      ubahNama.value = nama;
      ubahEmail.value = email;
      ubahNoTelp.value = no_telp;
      ubahAlamat.value = alamat;
    }
  </script>
@endsection