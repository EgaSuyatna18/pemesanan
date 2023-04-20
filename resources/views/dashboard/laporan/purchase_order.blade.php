@extends('layout.master')
@section('content')
<a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
<table class="table table-striped" id="datatable">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Syarat Pembayaran</th>
        <th scope="col">User</th>
        <th scope="col">Keterangan</th>
        <th scope="col">Tanggal Purchase Order</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($purchaseOrders as $po)
            <tr>
                <td scope="col">{{ $loop->index + 1 }}</td>
                <td>{{ $po->penawaran_harga->syarat_pembayaran }}</td>
                <td>{{ $po->user->name }}</td>
                <td>{{ $po->keterangan }}</td>
                <td>{{ $po->tgl_po }}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
@endsection