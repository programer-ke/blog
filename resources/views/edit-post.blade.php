<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="bg-light">

    
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card edit-post-card">
                    <div class="card-header bg-white">
                        <h3 class="mb-0">
                            <i class="bi bi-pencil-square"></i> Edit Post
                        </h3>
                    </div>
                    
                    <div class="card-body">
                        <form method="POST" action="/edit-post/{{ $post->id }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" 
                                       value="{{ $post->title }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="body" class="form-label">Content</label>
                                <textarea class="form-control" id="body" name="body" 
                                          rows="8" required>{{ $post->body }}</textarea>
                            </div>
                            
                            <div class="d-flex justify-content-between">
                                <a href="/" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save"></i> Update Post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>