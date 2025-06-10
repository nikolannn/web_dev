<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            {{-- Display Success Message --}}
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Logout Button --}}
            <form method="POST" action="{{ route('auth.logout') }}" class="text-end mb-3">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>

            {{-- Create New User Card --}}
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Add a New User</h3>
                </div>
                <div class="card-body bg-light">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter full name">
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter email address">
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Create a password">
                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>
                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Users List Card --}}
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Users List</h3>
                </div>
                <div class="card-body">
                    @if($users->isEmpty())
                        <div class="alert alert-warning text-center">No users found.</div>
                    @else
                        <div class="row g-3">
                            @foreach ($users as $user)
                                <div class="col-md-4">
                                    <div class="user-card d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $user->name }}</strong><br>
                                            <small class="text-muted">{{ $user->email }}</small>
                                        </div>
                                        <div class="btn-group">
                                            {{-- Edit Button --}}
                                            <button class="btn btn-sm text-white" style="background-color: #181091;" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                                Edit
                                            </button>

                                            {{-- Delete Form --}}
                                            <form method="POST" action="{{ route('user.delete', $user->id) }}" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm text-white" style="background-color: #020200;">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                {{-- Edit User Modal --}}
                                <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $user->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form method="POST" action="{{ route('user.update', $user->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="editUserModalLabel{{ $user->id }}">Edit User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Password</label>
                                                        <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                                                        @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- End Modal --}}
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Styles --}}
<style>
    .user-card {
        background-color: #84b9c6;
        padding: 1rem;
        border-radius: 0.5rem;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease-in-out;
    }
    .user-card:hover {
        transform: translateY(-3px);
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
