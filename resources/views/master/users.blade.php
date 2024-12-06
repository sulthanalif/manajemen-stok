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
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $k)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $k->name }}</td>
                                            <td>{{ $k->email }}</td>
                                            <td>{{ $k->roles[0]->name }}</td>
                                            <td class="text-center justify-content-center d-flex">
                                                <button class="btn btn-sm btn-primary mr-2"
                                                    data-toggle="modal"
                                                    data-target="#editModal{{ $k->id }}"><i class="fas fa-edit"></i></button>
                                                <form action="{{ route('users.destroy', $k->id) }}" method="POST">
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
                                                    <form action="{{ route('users.update', $k->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="name" class="col-form-label">Nama</label>
                                                                <input type="text" class="form-control" value="{{ $k->name }}" id="name"
                                                                    name="name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email" class="col-form-label">email</label>
                                                                <input type="email" class="form-control" value="{{ $k->email }}" id="email"
                                                                    name="email">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="password" class="col-form-label">Password</label>
                                                                <input type="password" class="form-control" value="" id="password"
                                                                    name="password" placeholder="Kosongkan jika tidak diubah..">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="role" class="col-form-label">Role</label>
                                                                <select name="role" id="role" class="custom-select">
                                                                    <option value=""  disabled>Pilih Role</option>
                                                                    @foreach ($roles as $r)
                                                                        <option value="{{ $r->name }}" {{ $k->roles[0]->name == $r->name ? 'selected' : '' }}>{{ $r->name }}</option>
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
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name" class="col-form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="email" class="col-form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label">Password</label>
                                <input type="text" class="form-control" id="password" name="password">
                            </div>
                            <div class="form-group">
                                <label for="role" class="col-form-label">Role</label>
                                <select name="role" id="role" class="custom-select">
                                    <option value="" selected disabled>Pilih Role</option>
                                    @foreach ($roles as $k)
                                        <option value="{{ $k->name }}">{{ $k->name }}</option>
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
