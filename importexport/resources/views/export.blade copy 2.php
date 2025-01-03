{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
{{-- <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" accept=".csv">
    <button type="submit">Import CSV</button>
</form> --}}
<div class="container">
    <h1>Import & Export Data & PDF Generate File</h1>

    <!-- Import Form -->
    <div class="card mb-4">
        <div class="card-header">Import Data</div>
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="file">Select File to Import (CSV, XLSX):</label>
                    <input type="file" name="file" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Import File</button>
            </form>
        </div>
    </div>

    <!-- Export Form -->
    <div class="card">
        <div class="card-header">Export Data</div>
        <div class="card-body">
            <form action="{{ route('export') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success">Export Data (CSV, XLSX)</button>
            </form>
        </div>
    </div>
    <!-- PDF Genrate Form -->
    <div class="card mb-4">
        <div class="card-header">PDF Genrate File</div>
        <div class="card-body">
            <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">

                </div>
                <button type="submit" class="btn btn-primary">Download PDF File</button>
            </form>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">PDF Generate File</div>
        <div class="card-body">
            {{-- <form action="{{ route('generate-pdf') }}" method="POST" enctype="multipart/form-data"> --}}
            <form>
                @csrf
                <div class="form-group">
                    <!-- Optional: Add input fields if needed -->
                </div>
                <button type="submit" class="btn btn-primary">Download PDF File</button>
            </form>
        </div>
    </div>

</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

{{-- @endsection --}}

<!-- resources/views/import-export.blade.php -->

{{-- @extends('layouts.app') --}}

{{-- @section('content') --}}
{{-- <div class="container">
    <h1>Import & Export Data</h1>

    <!-- Form for Import -->
    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Import CSV File</label>
            <input type="file" class="form-control" name="file" required>
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
    </form>

    <hr> --}}

<!-- Export Button -->
{{-- <form action="{{ route('export') }}" method="GET">
        <button type="submit" class="btn btn-success">Export Data</button>
    </form>

</div> --}}
{{-- @endsection --}}
