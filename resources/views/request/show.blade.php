@extends('components.layouts.app')

@section('title', 'Detail Request')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $modelsRequest->code }}</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>Tanggal:</strong>
                                {{ \Carbon\Carbon::parse($modelsRequest->tanggal)->format('d M Y') }}</p>
                            <p><strong>Nama Chef:</strong> {{ $modelsRequest->user->name }}</p>
                            @if (in_array($modelsRequest->status, ['Sudah Order', 'Success']))
                            <a target="_blank" href="{{ route('request.show', [$modelsRequest->id, 'export' => true]) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Cetak Invoice</a>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status:</strong> {{ $modelsRequest->status }}</p>
                            <p><strong>Waiting:</strong> {{ $modelsRequest->waiting ?? '-' }}</p>
                            <p><strong>Status Pembayaran:</strong> {{ $modelsRequest->is_payment ? 'Paid ('. $modelsRequest->method .')' : 'Unpaid' }}</p>
                        </div>
                    </div>

                    <livewire:request-table :modelsRequest="$modelsRequest" />
                    <div class="float-right mt-5">
                        <a href="javascript:window.history.back()" class="btn btn-secondary">Kembali</a>
                        @role('Kepala Toko||Owner')
                            {{-- <button type="button" class="btn btn-danger" onclick="reject({{ $modelsRequest->id }})">Reject</button> --}}
                            @if ($modelsRequest->status == 'Pending')
                                <a href="{{ route('request.status', [$modelsRequest->id, 'status' => 'B']) }}"
                                    class="btn btn-danger">Reject</a>
                                <a href="{{ route('request.status', [$modelsRequest->id, 'status' => 'A']) }}"
                                    class="btn btn-success">Acc</a>
                            @elseif ($modelsRequest->status == 'Sudah Order')
                                    <a href="{{ route('request.status', [$modelsRequest->id, 'status' => 'F']) }}" class="btn btn-success">Item Diterima</a>
                            @endif
                        @endrole

                        @role('Owner')
                            @if ($modelsRequest->status == 'Vendor Sudah Dipilih')
                                <a href="{{ route('request.status', [$modelsRequest->id, 'status' => 'C']) }}"
                                    class="btn btn-danger">Reject</a>
                                <a href="{{ route('request.status', [$modelsRequest->id, 'status' => 'D']) }}"
                                    class="btn btn-success">Acc</a>
                            @endif
                            @if ($modelsRequest->status == 'Approved by Owner')
                                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#bayarModal">Bayar</a>
                            @endif
                        @endrole

                        @role('Purchase')
                            @if ($modelsRequest->status == 'Paid' && $modelsRequest->is_payment == true)
                                <a href="{{ route('request.status', [$modelsRequest->id, 'status' => 'E']) }}" class="btn btn-success">Pesan Items</a>
                            @endif

                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal tambah -->
    <div class="modal fade" id="bayarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('request.payment', $modelsRequest->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="method" class="col-form-label">Methode Pembayaran</label>
                        <select class="form-control" id="method" name="method">
                            <option value="" selected disabled>Pilih Metode Pembayaran</option>
                            <option value="Cash">Cash</option>
                            <option value="Transfer">Transfer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-form-label">Bukti Pembayaran</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
