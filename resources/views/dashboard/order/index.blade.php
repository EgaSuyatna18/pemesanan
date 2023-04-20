@extends('layout.master')
@section('content')
<a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
@if (auth()->user()->role == 'staff_ppic')
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">
    <i class="fa fa-plus"></i> Tambah
</button>
@endif
<table class="table table-striped" id="datatable">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Produk</th>
        <th scope="col">Customer</th>
        <th scope="col">Qty</th>
        <th scope="col">Penawaran Harga</th>
        <th scope="col">Total Harga</th>
        <th scope="col">Tanggal Order</th>
        @if (auth()->user()->role == 'staff_ppic')
        <th scope="col">Action</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach ($orders as $order)
          <tr>
            <td scope="row">{{ $loop->index + 1 }}</td>
            <td>{{ $order->produk->deskripsi }}</td>
            <td>{{ $order->customer->nama }}</td>
            <td>{{ $order->qty }}</td>
            <td>{{ 'Rp' . number_format($order->penawaran_harga) }}</td>
            <td>{{ 'Rp' . number_format($order->total_harga) }}</td>
            <td>{{ $order->tgl_order }}</td>
            @if (auth()->user()->role == 'staff_ppic')
            <td>
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                onclick="setData('{{ $order->id }}', '{{ $order->produk->id }}', '{{ $order->customer->id }}', '{{ $order->qty }}', '{{ $order->penawaran_harga }}', '{{ $order->tgl_order }}')">
                <i class="fa fa-edit"></i> Ubah
              </button>
              <form action="/order" method="post" class="d-inline">
                @csrf
                @method('delete')
                <input type="hidden" name="id" value="{{ $order->id }}">
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </td>
            @endif
          </tr>
      @endforeach
    </tbody>
  </table>

  {{ $orders->links() }}

  <!-- tambah Modal -->
  <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/order" method="post" id="tambahForm">
            @csrf
            <div class="mb-3">
              <label>Produk</label>
              <select name="produk_id" class="select2Tambah" style="width: 100%;">
                @foreach ($produks as $produk)
                    <option value="{{ $produk->id }}">{{ $produk->deskripsi }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label>Customer</label>
              <select name="customer_id" class="select2Tambah" style="width: 100%;">
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label>Qty</label>
              <input type="number" name="qty" class="form-control">
            </div>
            <div class="mb-3">
              <label>Penawaran Harga</label>
              <input type="number" name="penawaran_harga" class="form-control">
            </div>
            <div class="mb-3">
              <label>Tanggal Order</label>
              <input type="date" name="tgl_order" class="form-control">
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
          <form action="/order" method="post" id="ubahForm">
            @csrf
            @method('put')
            <input type="hidden" name="id" id="ubahID">
            <div class="mb-3">
              <label>Produk</label>
              <select name="produk_id" class="select2Ubah" style="width: 100%;" id="ubahProdukID">
                @foreach ($produks as $produk)
                    <option value="{{ $produk->id }}">{{ $produk->deskripsi }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label>Customer</label>
              <select name="customer_id" class="select2Ubah" style="width: 100%;" id="ubahCustomerID">
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label>Qty</label>
              <input type="number" name="qty" class="form-control" id="ubahQty">
            </div>
            <div class="mb-3">
              <label>Penawaran Harga</label>
              <input type="number" name="penawaran_harga" class="form-control" id="ubahPenawaranHarga">
            </div>
            <div class="mb-3">
              <label>Tanggal Order</label>
              <input type="date" name="tgl_order" class="form-control" id="ubahTglOrder">
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
    function setData(id, produkID, customerID, qty, penawaranHarga, tglOrder) {
      ubahID.value= id;
      ubahProdukID.value = produkID;
      ubahCustomerID.value = customerID;
      ubahQty.value = qty;
      ubahPenawaranHarga.value = penawaranHarga;
      ubahTglOrder.value = tglOrder;
    }
  </script>
@endsection