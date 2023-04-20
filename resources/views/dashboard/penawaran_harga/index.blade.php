@extends('layout.master')
@section('content')
<a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
@if (auth()->user()->role == 'krani_ppic')
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">
    <i class="fa fa-plus"></i> Tambah
</button>
@endif
<table class="table table-striped" id="datatable">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">ID Order</th>
        <th scope="col">Produk</th>
        <th scope="col">Jangka Waktu</th>
        <th scope="col">Validasi Harga</th>
        <th scope="col">Syarat Pembayaran</th>
        @if (auth()->user()->role == 'krani_ppic')
        <th scope="col">Action</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach ($penawaranHargas as $pp)
          <tr>
            <td scope="row">{{ $loop->index + 1 }}</td>
            <td>{{ $pp->order->id }}</td>
            <td>{{ $pp->order->produk->deskripsi }}</td>
            <td>{{ $pp->jangka_waktu }}</td>
            <td>{{ 'Rp' . number_format($pp->validasi_harga) }}</td>
            <td>{{ $pp->syarat_pembayaran }}</td>
            @if (auth()->user()->role == 'krani_ppic')
            <td>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                onclick="setData('{{ $pp->id }}', '{{ $pp->order_id }}' ,'{{ $pp->jangka_waktu }}' ,'{{ $pp->validasi_harga }}' ,'{{ $pp->syarat_pembayaran }}'">
                <i class="fa fa-edit"></i> Ubah
              </button>
              <form action="/penawaranharga" method="post" class="d-inline">
                @csrf
                @method('delete')
                <input type="hidden" name="id" value="{{ $pp->id }}">
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </td>
            @endif
          </tr>
      @endforeach
    </tbody>
  </table>

  {{ $penawaranHargas->links() }}

  <!-- tambah Modal -->
  <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/penawaranharga" method="post" id="tambahForm">
            @csrf
            <div class="mb-3">
              <label>Order</label>
              <select name="order_id" class="select2Tambah" style="width: 100%;">
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}">{{ $order->id }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label>Jangka Waktu</label>
              <input type="date" name="jangka_waktu" class="form-control">
            </div>
            <div class="mb-3">
              <label>Validasi Harga</label>
              <input type="number" name="validasi_harga" class="form-control">
            </div>
            <div class="mb-3">
              <label>Syarat Pembayaran</label>
              <input type="text" name="syarat_pembayaran" class="form-control">
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
          <form action="/penawaranharga" method="post" id="ubahForm">
            @csrf
            @method('put')
            <input type="hidden" name="id" id="ubahID">
            <input type="hidden" name="order_old_id" id="ubahOrderOLDID">
            <div class="mb-3">
              <label>Order</label>
              <select name="order_id" class="select2Ubah" style="width: 100%;" id="ubahOrderID">
                <option value="" selected>-- abaikan jika tidak ingin diubah --</option>
                @foreach ($orders as $order)
                    <option value="{{ $order->id }}">{{ $order->id }}</option>
                @endforeach
              </select>
              <div class="form-text">abaikan jika tidak ingin diubah.</div>
            </div>
            <div class="mb-3">
              <label>Jangka Waktu</label>
              <input type="date" name="jangka_waktu" class="form-control" id="ubahJangkaWaktu">
            </div>
            <div class="mb-3">
              <label>Validasi Harga</label>
              <input type="number" name="validasi_harga" class="form-control" id="ubahValidasiHarga">
            </div>
            <div class="mb-3">
              <label>Syarat Pembayaran</label>
              <input type="text" name="syarat_pembayaran" class="form-control" id="ubahSyaratPembayaran">
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
    function setData(id, orderID, jangkaWaktu, validasiHarga, syaratPembayaran) {
      ubahID.value= id;
      ubahOrderOLDID.value = orderID;
      ubahOrderID.value = orderID;
      ubahJangkaWaktu.value = jangkaWaktu;
      ubahValidasiHarga.value = validasiHarga;
      ubahSyaratPembayaran.value = syaratPembayaran;
    }
  </script>
@endsection