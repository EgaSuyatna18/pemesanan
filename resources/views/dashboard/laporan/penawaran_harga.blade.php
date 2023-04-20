@extends('layout.master')
@section('content')
<a href="{{ url()->previous() }}" class="btn btn-danger">Back</a>
<table class="table table-striped" id="datatable">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Tanggal Order</th>
        <th scope="col">Jangka Waktu</th>
        <th scope="col">Validasi Harga</th>
        <th scope="col">Syarat Pembayaran</th>
        <th scope="col">Tanggal Validasi</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($penawaranHargas as $ph)
            <tr>
                <td scope="col">{{ $loop->index + 1 }}</td>
                <td>{{ $ph->order->tgl_order }}</td>
                <td>{{ $ph->jangka_waktu }}</td>
                <td>{{ 'Rp' . number_format($ph->validasi_harga) }}</td>
                <td>{{ $ph->syarat_pembayaran }}</td>
                <td>{{ $ph->tgl_validasi }}</td>
            </tr>
        @endforeach
    </tbody>
  </table>
@endsection