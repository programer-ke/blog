<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Application</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="bg-light">
    <div class="container py-4">
        @auth
        <!-- Navigation Bar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4 rounded-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">My Blog</a>
                <div class="d-flex align-items-center">
                    <span class="text-white me-3">Welcome, <strong>{{ auth()->user()->name }}</strong></span>
                    <form action="/logout" method="POST">
                        @csrf
                        <button class="btn btn-outline-light btn-sm">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Create Post Section -->
        <div class="card mb-4 post-card">
            <div class="card-body">
                <h2 class="card-title h4"><i class="bi bi-plus-circle"></i> Create a New Post</h2>
                <form action="/create-post" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Post title...">
                    </div>
                    <div class="mb-3">
                        <label for="body" class="form-label">Content</label>
                        <textarea class="form-control" id="body" name="body" rows="3" placeholder="Write your content here..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Save Post
                    </button>
                </form>
            </div>
        </div>

        <!-- User Posts Section -->
        <div class="card post-card">
            <div class="card-body">
                <h2 class="card-title h4"><i class="bi bi-journal-text"></i> Your Posts</h2>
                <div class="post-list">
                    @foreach ($posts as $post)
                    <div class="post-item">
                        <div class="post-header">
                            <div class="user-avatar">
                                {{ substr(auth()->user()->name, 0, 2) }}
                            </div>
                            <div>
                                <h3 class="post-title">{{$post['title']}}</h3>
                                <div class="post-time">Posted {{ $post->created_at->diffForHumans() }}</div>
                            </div>
                        </div>
                        <div class="post-content">{{$post['body']}}</div>
                        <div class="post-actions mt-3">
                            <a href="/edit-post/{{$post->id}}" class="btn btn-outline-primary btn-sm btn-action">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="/delete-post/{{$post->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm btn-action">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        @else
        <!-- Guest View (Login/Register) -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="auth-form mb-4">
                    <h2 class="h4 mb-4 text-center"><i class="bi bi-person-plus"></i> Register</h2>
                    <form action="/register" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Name">
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-person-plus"></i> Register
                        </button>
                    </form>
                </div>

                <div class="auth-form">
                    <h2 class="h4 mb-4 text-center"><i class="bi bi-box-arrow-in-right"></i> Login</h2>
                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" name="loginname" placeholder="Username">
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" name="loginpassword" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>