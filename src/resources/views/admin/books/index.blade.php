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
            
      <a href="/u/book/create" class="btn btn-primary py-2 px-3 fs-normal float-right mb-3 shadow-sm"><span class="fas fa-user-plus"></span> Tambah Data</a>
      
      <div class="table-responsive">
        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th class="text-center">NO</th>
              <th>Name</th>
              <th>Author</th>
              <th>Publisher</th>
              <th>Genre</th>
              <th>Publish At</th>
              <th>Price</th>
              <th>Book Pages</th>
              <th class="text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($books as $row)
            <tr>
              <td class="text-center">{{ $loop->iteration }}</td>
              <td>{{ $row->title }}</td>
              <td>{{ $row->author->name }}</td>
              <td>{{ $row->publisher->name }}</td>
              <td>{{ $row->genre->genre }}</td>
              <td>{{ $row->publish_date }}</td>
              <td>{{ $row->price }}</td>
              <td>{{ $row->book_pages }} Pages</td>
              <td class="text-center">
                
                <form action="/u/book/{{ $row->id }}" onsubmit="return confirm('Apakah anda yakin akan menghapus data?')" method="post">
                  @csrf
                  @method('DELETE')  
                  
                  <a href="/u/book/{{ $row->id }}/edit" class="btn fs-small btn-info text-decoration-none">
                    <span class="fa fa-fw fa-syringe mx-1"></span>
                    Edit
                  </a>

                  <button type="submit" class="btn fs-small btn-danger">
                    <span class="fa fa-fw fa-trash mx-1"></span>
                  Hapus
                  </button>
                </form>
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
