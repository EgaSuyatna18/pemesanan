@extends('layout.master')
@section('content')
<a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
<table class="table table-striped" id="datatable">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Produk</th>
        <th scope="col">Customer</th>
        <th scope="col">Qty</th>
        <th scope="col">Penawaran Harga</th>
        <th scope="col">Total Harga</th>
        <th scope="col">Tanggal Order</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td scope="col">{{ $loop->index + 1 }}</td>
                <td>{{ $order->produk->deskripsi }}</td>
                <td>{{ $order->customer->nama }}</td>
                <td>{{ $order->qty }}</td>
                <td>{{ 'Rp' . number_format($order->penawaran_harga) }}</td>
                <td>{{ 'Rp' . number_format($order->total_harga) }}</td>
                <td>{{ $order->tgl_order }}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
@endsection