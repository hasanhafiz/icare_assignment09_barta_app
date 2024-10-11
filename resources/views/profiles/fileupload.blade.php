<div class="container">
    
    <img src="{{ asset('storage/avatars/16411728670474.jpg') }}" alt="">
    
    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="upload_file" >
    <input type="submit" value="Upload File">
    </form>
</div>