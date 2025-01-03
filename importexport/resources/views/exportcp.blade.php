<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5 col-md-8">
        <h1 class="mb-4 text-center">Import, Export, and PDF Generate</h1>

        <!-- Import Form -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Import Data</div>
            <div class="card-body">
                {{-- <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data"> --}}
                <form>
                    @csrf
                    <div class="form-group mb-3">
                        <label for="file" class="form-label">Select File to Import (CSV, XLSX):</label>
                        <input type="file" id="file" name="file" class="form-control" required>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Import File</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Export Form -->
        <div class="card" style="margin-top: 5%">
            <div class="card-header bg-success text-white">Export Data</div>
            <div class="card-body">
                {{-- <form action="{{ route('export') }}" method="POST"> --}}
                <form>
                    @csrf
                    <div class="text-end">
                        <button type="submit" class="btn btn-success">Export Data (CSV, XLSX)</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- PDF Generate Form -->
        <div class="card mt-4" style="margin-top: 5%">
            <div class="card-header bg-info text-white">Generate PDF</div>
            <div class="card-body">
                {{-- <form action="{{ route('generate-pdf') }}" method="POST"> --}}
                <form>
                    @csrf
                    <div class="text-end">
                        <button type="submit" class="btn btn-info">Download PDF File</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Error Handling -->
        <!-- @if ($errors->any())
<div class="alert alert-danger mt-4">
            <h4 class="alert-heading">Errors</h4>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
            </ul>
        </div>
@endif -->
    </div>


    <!-- <div class="container">
  <h2>Vertical (basic) form</h2>
  <form action="/action_page.php">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="remember"> Remember me</label>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div> -->

</body>

</html>
