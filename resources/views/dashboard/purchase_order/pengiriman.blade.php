@extends('layout.master')
@section('content')
<a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
<table class="table table-striped" id="datatable">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">ID PO</th>
        <th scope="col">Tanggal Kirim</th>
        <th scope="col">Penerima</th>
        <th scope="col">Driver</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($pengirimans as $pengiriman)
          <tr>
            <td scope="row">{{ $loop->index + 1 }}</td>
            <td>{{ $pengiriman->purchase_order_id }}</td>
            <td>{{ $pengiriman->tgl_kirim }}</td>
            <td>{{ $pengiriman->purchase_order->penawaran_harga->order->customer->nama }}</td>
            <td>{{ $pengiriman->driver }}</td>
          </tr>
      @endforeach
    </tbody>
  </table>

  {{ $pengirimans->links() }}

@endsection