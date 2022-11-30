<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
    <form method="post" action="{{ route('upload') }}" class="form-container" enctype='multipart/form-data'>
        @csrf
        <input type="file" name="csv">
        <button type="submit">Upload</button>
    </form>
</body>
</html>