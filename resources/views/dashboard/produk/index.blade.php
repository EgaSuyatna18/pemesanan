@extends('layout.master')
@section('content')
<a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
@if (auth()->user()->role == 'staff_ppic' || auth()->user()->role == 'kepala_gudang')
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">
  <i class="fa fa-plus"></i> Tambah
</button>
@endif
<table class="table table-striped" id="datatable">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Kategori</th>
        <th scope="col">Deskripsi</th>
        <th scope="col">Stok</th>
        <th scope="col">Unit</th>
        <th scope="col">Harga</th>
        @if (auth()->user()->role == 'staff_ppic' || auth()->user()->role == 'kepala_gudang')
        <th scope="col">Action</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach ($produks as $produk)
          <tr>
            <td scope="row">{{ $loop->index + 1 }}</td>
            <td>{{ $produk->kategori }}</td>
            <td>{{ $produk->deskripsi }}</td>
            <td>{{ $produk->stok }}</td>
            <td>{{ $produk->unit }}</td>
            <td>{{ 'Rp' . number_format($produk->harga) }}</td>
            @if (auth()->user()->role == 'staff_ppic' || auth()->user()->role == 'kepala_gudang')
            <td>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                onclick="setData('{{ $produk->id }}', '{{ $produk->kategori }}', '{{ $produk->deskripsi }}', '{{ $produk->stok }}', '{{ $produk->unit }}', '{{ $produk->harga }}')">
                <i class="fa fa-edit"></i> Ubah
              </button>
              <form action="/produk" method="post" class="d-inline">
                @csrf
                @method('delete')
                <input type="hidden" name="id" value="{{ $produk->id }}">
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </td>
            @endif
          </tr>
      @endforeach
    </tbody>
  </table>

  {{ $produks->links() }}

  <!-- tambah Modal -->
  <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/produk" method="post" id="tambahForm">
            @csrf
            <div class="mb-3">
                <label>Kategori</label>
                <select name="kategori" class="form-control">
                    <option value="Barang">Barang</option>
                    <option value="Jasa">Jasa</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control">
            </div>
            <div class="mb-3">
                <label>Unit</label>
                <select name="unit" class="form-control">
                    <option value="PCS">PCS</option>
                    <option value="LOT">LOT</option>
                    <option value="SET">SET</option>
                    <option value="EA">EA</option>
                    <option value="UN">UN</option>
                    <option value="M">M</option>
                    <option value="DLL">DLL</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control">
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
          <form action="/produk" method="post" id="ubahForm">
            @csrf
            @method('put')
            <input type="hidden" name="id" id="ubahID">
            <div class="mb-3">
                <label>Kategori</label>
                <select name="kategori" class="form-control" id="ubahKategori">
                    <option value="Barang">Barang</option>
                    <option value="Jasa">Jasa</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" id="ubahDeskripsi"></textarea>
            </div>
            <div class="mb-3">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" id="ubahStok">
            </div>
            <div class="mb-3">
                <label>Unit</label>
                <select name="unit" class="form-control" id="ubahUnit">
                    <option value="PCS">PCS</option>
                    <option value="LOT">LOT</option>
                    <option value="SET">SET</option>
                    <option value="EA">EA</option>
                    <option value="UN">UN</option>
                    <option value="M">M</option>
                    <option value="DLL">DLL</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" id="ubahHarga">
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
    function setData(id, kategori, deskripsi, stok, unit, harga) {
      ubahID.value= id;
      ubahKategori.value = kategori;
      ubahDeskripsi.value = deskripsi;
      ubahStok.value = stok;
      ubahUnit.value = unit;
      ubahHarga.value = harga;
    }
  </script>
@endsection