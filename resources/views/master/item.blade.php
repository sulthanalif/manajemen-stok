@extends('components.layouts.app')

@section('title', 'Items')

@section('content')
    <div class="row ">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    {{-- <button class="btn btn-primary" @click="create = ! create">Tambah Data</button> --}}
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
                        Tambah Data
                    </button>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $k)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $k->nama }}</td>
                                            <td>{{ $k->kategori->nama }}</td>
                                            <td>{{ $k->stok }}{{ $k->satuan->simbol }}</td>
                                            <td class="text-center justify-content-center d-flex">
                                                <button class="btn btn-sm btn-primary mr-2"
                                                    data-toggle="modal"
                                                    data-target="#editModal{{ $k->id }}"><i class="fas fa-edit"></i></button>
                                                <form action="{{ route('item.destroy', $k->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type='submit' class="btn btn-sm btn-danger"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- Modal edit -->
                                        <div class="modal fade" id="editModal{{ $k->id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('item.update', $k->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="nama" class="col-form-label">Nama</label>
                                                                <input type="text" class="form-control" value="{{ $k->nama }}" id="nama"
                                                                    name="nama">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="kategori_id" class="col-form-label">Kategori</label>
                                                                <select name="kategori_id" id="kategori_id" class="custom-select">
                                                                    <option value=""  disabled>Pilih Kategori</option>
                                                                    @foreach ($kategoris as $ka)
                                                                        <option value="{{ $ka->id }}" {{ $ka->id == $k->kategori_id ? 'selected' : '' }}>{{ $ka->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="stok" class="col-form-label">Stok</label>
                                                                <input type="number" class="form-control" id="stok" value="{{ old('stok', $k->stok) }}" name="stok">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="satuan_id" class="col-form-label">Satuan</label>
                                                                <select name="satuan_id" id="satuan_id" class="custom-select">
                                                                    <option value=""  disabled>Pilih Satuan</option>
                                                                    @foreach ($satuans as $s)
                                                                        <option value="{{ $s->id }}" {{ $s->id == $k->satuan_id ? 'selected' : '' }}>{{ $s->nama }} ({{ $s->simbol }})</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Modal tambah -->
        <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('item.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama" class="col-form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="kategori_id" class="col-form-label">Kategori</label>
                                <select name="kategori_id" id="kategori_id" class="custom-select">
                                    <option value="" selected disabled>Pilih Kategori</option>
                                    @foreach ($kategoris as $k)
                                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="stok" class="col-form-label">Stok</label>
                                <input type="number" class="form-control" id="stok" name="stok">
                            </div>
                            <div class="form-group">
                                <label for="satuan_id" class="col-form-label">Satuan</label>
                                <select name="satuan_id" id="satuan_id" class="custom-select">
                                    <option value="" selected disabled>Pilih Satuan</option>
                                    @foreach ($satuans as $s)
                                        <option value="{{ $s->id }}">{{ $s->nama }} ({{ $s->simbol }})</option>
                                    @endforeach
                                </select>
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

    </div>

@endsection
