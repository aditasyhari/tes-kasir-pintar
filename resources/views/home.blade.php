@extends('layouts.app')

@section('title') Dashboard @endsection

@section('content')
<div class="row">
  <div class="col-12 col-xl-8 mb-4 mb-xl-0">
    <h3 class="font-weight-bold">Selamat Datang</h3>
    <h6 class="font-weight-normal mb-0">Aplikasi stok barang di <span class="text-primary">Kasir Pintar</span>.</h6>
  </div>
</div>
<div class="row mt-3">
    <div class="col-md-9 grid-margin stretch-card">
      <div class="card ">
        <div class="card-people mt-auto">
          <img src="{{ asset('template/images/dashboard/inventory.png') }}">
        </div>
      </div>
    </div>
    <div class="col-md-3 grid-margin transparent">
      <div class="row">
        <div class="col-md-12 mb-4 stretch-card transparent">
          <div class="card card-tale">
            <div class="card-body">
              <p class="mb-4">Jumlah Barang</p>
              <p class="fs-30 mb-2 jumlahbarang">{{ $jumlah }}</p>
              <p>Jumlah Seluruh Barang</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mb-4 mb-lg-0 stretch-card transparent">
          <div class="card card-light-blue">
            <div class="card-body">
              <p class="mb-4">Total Barang</p>
              <p class="fs-30 mb-2 barangmasuk">{{ $total }}</p>
              <p>Total Jumlah Semua Barang</p>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection