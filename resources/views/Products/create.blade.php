<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Add New Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightpink;">

<div class="container mt-5">
    <div class="card border-0 shadow rounded">
        <div class="card-body">
            <form enctype="multipart/form-data" action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Product Category</label>
                    <select class="form-control" id="product_category_id" name="product_category_id">
                        <option value="">-- Select Category Product --</option>
                        @foreach ($data['categories'] as $category)
                            <option value="{{ $category->id }}">{{ $category->product_category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Supplier</label>
                    <select class="form-control" id="id_supplier" name="id_supplier">
                        <option value="">-- Select Supplier --</option>
                        @foreach ($data['suppliers'] as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">IMAGE</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">TITLE</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Masukkan Judul Produk">
                </div>

               
    

                <div class="form-group mb-3">
                    <label class="font-weight-bold">DESCRIPTION</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5" placeholder="Masukkan Deskripsi Produk"></textarea>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">PRICE</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Masukkan Harga Produk">
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">STOCK</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" placeholder="Masukkan Stock Produk">
                </div>

                <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                <button type="button" id="resetform" onclick="resetForm()" class="btn btn-md btn-warning">RESET</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

<script>
    CKEDITOR.replace('description');

    function resetForm() {
        document.getElementById("productForm").reset(); // Reset semua nilai dalam form

        // Reset CKEditor content to empty
        for (var instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData(''); // Reset CKEditor content
        }
    }
</script>

</body>
</html>