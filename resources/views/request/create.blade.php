@extends('components.layouts.app')

@section('title', 'Request Items')

@section('content')
    <div class="row ">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    {{-- <button class="btn btn-primary" @click="create = ! create">Tambah Data</button> --}}
                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
                        Tambah Data
                    </button> --}}

                    <div class="card-body">
                        <livewire:form-request />
                    </div>
                </div>
            </div>

        </div>


    </div>

@endsection



