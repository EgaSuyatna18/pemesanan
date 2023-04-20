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
        <th scope="col">ID Penawaran Harga</th>
        <th scope="col">Keterangan</th>
        <th scope="col">Tanggal PO</th>
        <th scope="col">User</th>
        @if (auth()->user()->role == 'staff_ppic')
          <th scope="col">Action</th>
        @endif
      </tr>
    </thead>
    <tbody>
      @foreach ($purchaseOrders as $po)
          <tr>
            <td scope="row">{{ $loop->index + 1 }}</td>
            <td>{{ $po->penawaran_harga_id }}</td>
            <td>{{ $po->keterangan }}</td>
            <td>{{ $po->tgl_po }}</td>
            <td>{{ $po->user->name }}</td>
            @if (auth()->user()->role == 'krani_gudang')
            <td>
              <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#kirimModal"
                onclick="setData2('{{ $po->id }}')">
              <i class="fa fa-paper-plane"></i> Kirim
              </button>
              @elseif (auth()->user()->role == 'staff_ppic')
              <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ubahModal"
                onclick="setData('{{ $po->id }}', '{{ $po->penawaran_harga_id }}', '{{ $po->keterangan }}' ,'{{ $po->tgl_po }}')">
                <i class="fa fa-edit"></i> Ubah
              </button>
              <form action="/purchaseorder" method="post" class="d-inline">
                @csrf
                @method('delete')
                <input type="hidden" name="id" value="{{ $po->id }}">
                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </td>
            @endif
          </tr>
      @endforeach
    </tbody>
  </table>

  {{ $purchaseOrders->links() }}

  <!-- tambah Modal -->
  <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="tambahModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/purchaseorder" method="post" id="tambahForm">
            @csrf
            <div class="mb-3">
              <label>Penawaran Harga</label>
              <select name="penawaran_harga_id" class="select2Tambah" style="width: 100%">
                @foreach ($penawaranHargas as $ph)
                    <option value="{{ $ph->id }}">{{ $ph->id }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label>Keterangan</label>
              <select name="keterangan" class="form-control" id="ubahKeterangan">
                <option value="Lunas">Lunas</option>
                <option value="Belum Lunas">Belum Lunas</option>
              </select>
            </div>
            <div class="mb-3">
              <label>Tanggal PO</label>
              <input type="date" name="tgl_po" class="form-control">
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
          <form action="/purchaseorder" method="post" id="ubahForm">
            @csrf
            @method('put')
            <input type="hidden" name="id" id="ubahID">
            <input type="hidden" name="penawaran_harga_old_id" id="penawaranHargaOLDID">
            <div class="mb-3">
              <label>Penawaran Harga</label>
              <select name="penawaran_harga_id" class="select2Ubah" style="width: 100%" id="ubahPenawaranHargaID">
                <option value="" selected>-- abaikan jika tidak ingin diubah --</option>
                @foreach ($penawaranHargas as $ph)
                    <option value="{{ $ph->id }}">{{ $ph->id }}</option>
                @endforeach
              </select>
              <div class="form-text">abaikan jika tidak ingin diubah.</div>
            </div>
            <div class="mb-3">
              <label>Keterangan</label>
              <select name="keterangan" class="form-control" id="ubahKeterangan">
                <option value="Lunas">Lunas</option>
                <option value="Belum Lunas">Belum Lunas</option>
              </select>
            </div>
            <div class="mb-3">
              <label>Tanggal PO</label>
              <input type="date" name="tgl_po" class="form-control" id="ubahTglPO">
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

  <!-- kirim Modal -->
  <div class="modal fade" id="kirimModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="kirimModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="kirimModalLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/purchaseorder/kirim" method="post" id="kirimForm">
            @csrf
            <input type="hidden" name="purchase_order_id" id="kirimPOID">
            <div class="mb-3">
              <label>Transportir</label>
              <select name="transportir_id" class="select2Kirim" style="width: 100%">
                @foreach ($transportirs as $transportir)
                    <option value="{{ $transportir->id }}">{{ $transportir->kendaraan }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label>Tanggal Kirim</label>
              <input type="date" name="tgl_kirim" class="form-control">
            </div>
            <div class="mb-3">
              <label>Driver</label>
              <input type="text" name="driver" class="form-control">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" form="kirimForm" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    function setData(id, penawaranHargaID, keterangan, tglPO) {
      ubahID.value= id;
      penawaranHargaOLDID.value = penawaranHargaID;
      ubahKeterangan.value = keterangan;
      ubahTglPO.value = tglPO;
    }

    function setData2(id) {
      kirimPOID.value = id;
    }
  </script>
@endsection