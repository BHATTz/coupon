<form action="{{ route('import', 1) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" accept=".csv">
    <button type="submit">Import CSV</button>
    <a href="{{ route('export') }}">Export CSV</a>
</form>
