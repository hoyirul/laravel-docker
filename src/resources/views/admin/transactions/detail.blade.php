@extends('admin.layouts.main')

@section('content')
<!-- Begin Page Content -->
<div class="container fs-normal">

  <!-- Page Heading -->
  <p class="mb-3">Tabel / Data / <span class="color-primary">{{ $title }}</span></p>

  @if(session('success'))
    <div class="alert alert-success">
      {{session('success')}}
    </div>
  @endif
  @if(session('danger'))
  <div class="alert alert-danger">
    {{session('danger')}}
  </div>
  @endif

  <!-- DataTales Example -->
  <div class="card shadow mb-5 border-0">
    <div class="card-body">
      <h5 class="m-0 font-weight-bold color-primary mb-2">{{ $title }} - {{ $orders->id }}</h5>
      <p class="mb-3 float-left">Halaman ini untuk pengelolaan {{ strtolower($title) }}</p>

      <table class="table fs-normal table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col"># Transaction ID</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Order Date</th>
            <th scope="col">Comments</th>
            <th scope="col" class="text-center">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>#{{ $orders->id }}</td>
            <td>{{ $orders->customer->name }}</td>
            <td>{{ $orders->order_date }}</td>
            <td>{{ $orders->comments }}</td>
            <td class="text-center">
              @if ($orders->status == 'unpaid')
                <span class="badge bg-badge-danger px-3 py-2 font-medium text-danger rad-6 fs-small">Unpaid</span>
              @else
                <span class="badge bg-badge-success px-3 py-2 font-medium color-primary rad-6 fs-small">Paid</span>
              @endif
            </td>
          </tr>
        </tbody>
      </table>

      <div class="table-responsive">
        <table class="table fs-normal table-striped table-bordered">
          <thead>
            <tr>
              <th scope="col" class="text-center">#</th>
              <th scope="col">Book Name</th>
              <th scope="col">Qty x Price</th>
              <th scope="col">Discount</th>
              <th scope="col">Subtotal</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($order_details as $item)
              <tr>
                <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                <td>{{ $item->book->title }}</td>
                <td>{{ $item->qty.' x Rp. '.number_format($item->price) }}</td>
                <td>{{ $item->discount }}%</td>
                <td>Rp. {{ number_format($item->subtotal) }}</td>
              </tr>
            @endforeach
            <tr class="font-semibold">
              <th scope="col" class="text-center">#</th>
              <th style="text-align: right" scope="col" colspan="3">Total</th>
              <th scope="col">Rp. {{ number_format($total) }}</th>
            </tr>
          </tbody>
        </table>
        
      </div>
      
      <a href="/u/transaction" class="btn btn-primary py-2 shadow-sm fs-normal align-self-center px-3 mt-1">
        <span class="fas fa-arrow-left"></span> Kembali</a>

    </div>
  </div>

</div>
<!-- /.container-fluid -->
@endsection
