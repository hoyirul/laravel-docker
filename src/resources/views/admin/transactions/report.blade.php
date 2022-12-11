<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Bookstore | 2022</title>
  <style>
    /* @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');  */

    body{
      font-family: sans-serif;
      padding: 2px;
    }

    .text-center{
      text-align: center;
    }

    table{
      border: 1px solid #eee;
      border-collapse: collapse;
      width: 100%
    }

    th{
      font-family: sans-serif;
      padding: 6px;
      font-size: 8pt;
      text-align: left;
      border: 1px solid #eee;
    }

    td{
      padding: 6px;
      font-size: 8pt;
      border: 1px solid #eee;
    }

    .container{
      width: 100%;
    }

    .badge{
      padding: 2px 8px;
      border-radius: 0px;
      font-family: sans-serif;
      font-size: 6pt;
    }

    .bg-badge-success{
        background-color: #cbeae4 !important;
    }

    .bg-badge-grey{
        background-color: #e3e3e3 !important;
    }

    .bg-badge-danger{
        background-color: #f4d5d8 !important;
    }

    .bg-badge-info{
        background-color: #caefff !important;
    }

    .font-medium{
      font-family: sans-serif;
      font-size: 10pt;
    }

    .font-semibold{
      font-family: sans-serif;
    }
  </style>
</head>
<body>
  
  <div class="container">

    <div class="row main mb-1">
      <div class="col-md-12 mb-3">
        <h3 class="float-start font-semibold text-center">{{ $title = 'Transaction Reports'}}</h3>
      </div>

      <p class="float-start font-medium">Date : {{ now() }}</p>
      <table border="1" class="table fs-normal table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col" class="text-center">#</th>
            <th scope="col">TransactionID</th>
            {{-- <th scope="col">Email</th> --}}
            <th scope="col">Customer</th>
            <th scope="col">Phone</th>
            <th scope="col">Order Date</th>
            <th scope="col">Total</th>
            <th scope="col">Comments</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($orders as $item)
            <tr>
              <td class="text-center">{{ $loop->iteration }}</td>
              <td>#{{ $item->id }}</td>
              {{-- <td>{{ $item->customer->user->email }}</td> --}}
              <td>{{ $item->customer->name }}</td>
              <td>{{ $item->customer->phone_number }}</td>
              <td>{{ $item->order_date }}</td>
              <td>Rp. {{ number_format($item->total) }}</td>
              <td>{{ $item->comments }}</td>
              <td style="text-align: center">
                @if ($item->status == 'unpaid')
                  <span style="color: #dc3545" class="badge bg-badge-danger px-3 py-2 font-medium text-danger rad-6 fs-small">Unpaid</span>
                @else
                  <span style="color: #54a591" class="badge bg-badge-success px-3 py-2 font-medium color-primary rad-6 fs-small">Paid</span>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
    <br>
    <div class="p-3"></div>
    <footer style="text-align: center; font-size: 10pt">
      <p style="color: gray" class="text-center fs-normal">&copy; 2022 All Rights Reserved | Bookstore 2022</p>
    </footer>
  </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>