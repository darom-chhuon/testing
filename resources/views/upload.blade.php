
    <form action="{{ route('doc.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" accept=".docx" required>
        <button type="submit">Upload</button>
    </form>
