@extends('components.layouts.app')

@section('title', 'Vendor')

@section('content')
    <div class="row ">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    {{-- <button class="btn btn-primary" @click="create = ! create">Tambah Data</button> --}}
                    <div class="d-flex justify-content-between items-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
                            Tambah Data
                        </button>
                        <div>
                            <a target="_blank" href="{{ route('vendors.index', array_merge(request()->query(), ['export' => 1])) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Cetak List</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No Tlp</th>
                                        <th>Alamat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vendors as $k)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $k->nama }}</td>
                                            <td>{{ $k->email }}</td>
                                            <td>{{ $k->nomor }}</td>
                                            <td>{{ $k->alamat }}</td>
                                            <td class="text-center justify-content-center d-flex">
                                                <button class="btn btn-sm btn-primary mr-2"
                                                    data-toggle="modal"
                                                    data-target="#editModal{{ $k->id }}"><i class="fas fa-edit"></i></button>
                                                <form action="{{ route('vendors.destroy', $k->id) }}" method="POST">
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
                                                    <form action="{{ route('vendors.update', $k->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="nama" class="col-form-label">Nama</label>
                                                                <input type="text" class="form-control" value="{{ $k->nama }}" id="nama" name="nama" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email" class="col-form-label">Email</label>
                                                                <input type="email" class="form-control" value="{{ $k->email }}" id="email" name="email" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nomor" class="col-form-label">No Tlp</label>
                                                                <input type="number" class="form-control" value="{{ $k->nomor }}" id="nomor" name="nomor" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="alamat" class="col-form-label">Alamat</label>
                                                                <input type="text" class="form-control" value="{{ $k->alamat }}" id="alamat" name="alamat" required>
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
                        <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('vendors.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama" class="col-form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="nomor" class="col-form-label">No Tlp</label>
                                <input type="number" class="form-control" id="nomor" name="nomor" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="col-form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
