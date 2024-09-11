<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Data Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightpink">
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-12">
        <div>
          <h3 class="text-center my-4">Tutorial Laravel 11</h3>
          <hr>
          <div class="card border-0 shadow-sm rounded">
            <div class="card-body">
              <a href="{{ route('products.create') }}" class="btn btn-md btn-success mb-3">ADD PRODUCT</a>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Products (iterate in Laravel) -->
                  @forelse ($products as $product)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $product->name }}</td>
                      <td>{{ $product->price }}</td>
                      <td>
                        <img src="{{ Storage::url('public/products/'.$product->image) }}" class="rounded" style="width: 150px">
                      </td>
                      <td class="text-center">
                        <form onsubmit="return confirm('Are you sure?');" action="{{ route('products.destroy', $product->id) }}" method="POST">
                          <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                        </form>
                      </td>
                    </tr>
                  @empty
                    <div class="alert alert-danger">
                      Data product not available.
                    </div>
                  @endforelse
                </tbody>
              </table>
              {{ $products->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    // Message with SweetAlert
    @if (session('success'))
      Swal.fire({
        icon: 'success',
        title: 'SUCCESS!',
        text: '{{ session('success') }}',
        showConfirmButton: false,
        timer: 2000
      });
    @elseif (session('error'))
      Swal.fire({
        icon: 'error',
        title: 'FAILED!',
        text: '{{ session('error') }}',
        showConfirmButton: false,
        timer: 2000
      });
    @endif
  </script>
</body>
</html>
