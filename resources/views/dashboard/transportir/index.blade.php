@extends('layout.master')
@section('content')
<a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
@if (auth()->user()->role == 'krani_gudang')
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">
    <i class="fa fa-plus"></i> Tambah
</button>
@endif
<table class="table table-striped" id="datatable">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Kendaraan</th>
        <th scope="col">No Polisi</th>
        <th scope="col">Keterangan</th>
        @if (auth()->user()->role == 'krani_gudang')
        <th scope="col">Action</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach ($transportirs as $transportir)
          <tr>
            <td scope="row">{{ $loop->index + 1 }}</td>
            <td>{{ $transportir->kendaraan }}</td>
            <td>{{ $transportir->no_polisi }}</td>
            <td>{{ $transportir->keterangan }}</td>
            @if (auth()->user()->role == 'krani_gudang')
            <td>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                onclick="setData('{{ $transportir->id }}', '{{ $transportir->kendaraan }}', '{{ $transportir->no_polisi }}' ,'{{ $transportir->keterangan }}')">
                <i class="fa fa-edit"></i> Ubah
              </button>
              <form action="/transportir" method="post" class="d-inline">
                @csrf
                @method('delete')
                <input type="hidden" name="id" value="{{ $transportir->id }}">
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </td>
            @endif
          </tr>
      @endforeach
    </tbody>
  </table>

  {{ $transportirs->links() }}

  <!-- tambah Modal -->
  <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/transportir" method="post" id="tambahForm">
            @csrf
            <div class="mb-3">
              <label>Kendaraan</label>
              <input type="text" name="kendaraan" class="form-control">
            </div>
            <div class="mb-3">
              <label>No Polisi</label>
              <input type="text" name="no_polisi" class="form-control">
            </div>
            <div class="mb-3">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control"></textarea>
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
          <form action="/transportir" method="post" id="ubahForm">
            @csrf
            @method('put')
            <input type="hidden" name="id" id="ubahID">
            <div class="mb-3">
              <label>Kendaraan</label>
              <input type="text" name="kendaraan" class="form-control" id="ubahKendaraan">
            </div>
            <div class="mb-3">
              <label>No Polisi</label>
              <input type="text" name="no_polisi" class="form-control" id="ubahNoPolisi">
            </div>
            <div class="mb-3">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control" id="ubahKeterangan"></textarea>
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
    function setData(id, kendaraan, no_polisi, keterangan) {
      ubahID.value= id;
      ubahKendaraan.value = kendaraan;
      ubahNoPolisi.value = no_polisi;
      ubahKeterangan.value = keterangan;
    }
  </script>
@endsection