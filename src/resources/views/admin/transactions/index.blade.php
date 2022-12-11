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
      <h5 class="m-0 font-weight-bold color-primary mb-2">Tabel Data {{ $title }}</h5>
      <p class="mb-3 float-left">Halaman ini untuk pengelolaan {{ strtolower($title) }}</p>
      <a href="/u/transaction/report" target="_blank" class="btn btn-primary py-2 px-3 fs-normal float-right mb-3 shadow-sm"><span class="fas fa-print"></span> Print Laporan</a>

      <div class="table-responsive">
        <table id="dataTable" class="table fs-normal table-striped">
          <thead>
            <tr>
              <th scope="col" class="text-center">#</th>
              <th scope="col">INV</th>
              <th scope="col">Email</th>
              <th scope="col">Customer</th>
              <th scope="col">Phone</th>
              <th scope="col">Date Order</th>
              <th scope="col">Total</th>
              <th scope="col">Action</th>
              <th scope="col" class="text-center">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $item)
              <tr>
                <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                <td>#{{ $item->id }}</td>
                <td>{{ $item->customer->user->email }}</td>
                <td>{{ $item->customer->name }}</td>
                <td>{{ $item->customer->phone_number }}</td>
                <td>{{ $item->order_date }}</td>
                <td>Rp. {{ number_format($item->total) }}</td>
                <td>
                  <a href="/u/transaction/{{ $item->id }}/detail" class="badge p-2 bg-badge-info color-info rad-6 fs-small text-decoration-none">Detail</a>
                  @if ($item->status == 'unpaid')
                    <a href="/u/transaction/{{ $item->id }}/status" onclick="return confirm('Are you sure want to change data?')" class="badge p-2 bg-badge-warning color-warning rad-6 fs-small text-decoration-none">Update to Paid</a>
                  @endif
                </td>
                <td class="text-center">
                  @if ($item->status == 'unpaid')
                    <span class="badge bg-badge-danger p-2 text-danger rad-6 fs-small">Unpaid</span>
                  @else
                    <span class="badge bg-badge-success p-2 color-primary rad-6 fs-small">Paid</span>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
@endsection
