<?php

include "koneksi.php";


$query_read = "SELECT id, task, is_done, updated_at, created_at FROM todo ORDER BY id DESC";
$read_data = mysqli_query($conn, $query_read);



// CREATE
if (isset($_POST['create'])){
    $task = $_POST['task'];

    $query = "INSERT INTO todo (task, is_done, created_at, updated_at) VALUES ('$task', 0, NOW(), NOW())";

    $create_data = mysqli_query($conn, $query);
    echo "<script>window.location.href='/TODO-LIST-SIMPLE/index.php';</script>"; 

}

// DELETE
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    if ($delete_id > 0) {
        $query_delete = "DELETE FROM todo WHERE id = $delete_id";
        mysqli_query($conn, $query_delete);
        echo "<script>window.location.href='/TODO-LIST-SIMPLE/index.php';</script>"; 
        exit();
    }
}


// UPDATE
if (isset($_POST['update'])){
    $id = isset($_POST['update_id']) ? intval($_POST['update_id']) : 0;
    $task_update = isset($_POST['task_update']) ? trim($_POST['task_update']) : '';
    $is_done = isset($_POST['is_done']) ? intval($_POST['is_done']) : 0; 

    if ($id > 0 && !empty($task_update)){

        $query = "UPDATE todo SET task='$task_update', is_done='$is_done', updated_at=NOW() WHERE id=$id";
        $update_data = mysqli_query($conn, $query);

        if ($update_data){
            echo "<script>window.location.href='/TODO-LIST-SIMPLE/index.php';</script>"; 
        }else{
            echo "Error";
        }
    }else{
        echo "ID tidak valid";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <!-- 00. Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid col-md-7">
            <div class="navbar-brand">Simple To Do List</div>
            
            <div class="navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Akun Saya
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                            <li><a class="dropdown-item" href="#">Update Data</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
       
        </div>
    </nav>
    
    <div class="container mt-4">
    <!-- 01. Content-->
    <h1 class="text-center mb-4">To Do List</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <!-- 02. Form input data -->
                    <form id="todo-form" action="" method="post">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="task" id="todo-input"
                                placeholder="Tambah task baru" required>
                            <button class="btn btn-primary" type="submit" name="create">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <!-- 03. Searching -->
                    <form id="search-form" action="" method="get">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="search" 
                                placeholder="Masukkan kata kunci">
                            <button class="btn btn-secondary" type="submit">
                                Cari
                            </button>
                        </div>
                    </form>

                    <ul class="list-group mb-4" id="todo-list">
                        <?php while ($data_table = mysqli_fetch_array($read_data)) { ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="task-text fw-bold"><?php echo $data_table['task']; ?></span>
                                    <div class="small text-muted">
                                        Dibuat: <?php echo $data_table['created_at']; ?> | 
                                        Diupdate: <?php echo $data_table['updated_at']; ?>
                                    </div>
                                </div>

                                <div class="btn-group">
                                    <a href="?delete_id=<?php echo $data_table['id']; ?>" 
                                        class="btn btn-danger btn-sm delete-btn">✕</a>

                                    <button class="btn btn-primary btn-sm edit-btn" data-bs-toggle="collapse"
                                        data-bs-target="#update-<?php echo $data_table['id']; ?>" 
                                        aria-expanded="false">✎</button>
                                </div>
                            </li>
                            <!-- 05. Update Data -->
                            <li class="list-group-item collapse" id="update-<?php echo $data_table['id']; ?>">
                                <form action="" method="POST">
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="update_id" value="<?php echo $data_table['id']; ?>">
                                        <input type="text" class="form-control" name="task_update"
                                            value="<?php echo $data_table['task']; ?>">
                                        <button class="btn btn-outline-primary" type="submit" name="update">
                                            Update
                                        </button>
                                    </div>
                                    <div class="d-flex">
                                        <div class="radio px-2">
                                            <label>
                                                <input type="radio" value="1" name="is_done" 
                                                    <?php echo $data_table['is_done'] ? 'checked' : ''; ?>> 
                                                Selesai
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" value="0" name="is_done" 
                                                    <?php echo !$data_table['is_done'] ? 'checked' : ''; ?>> 
                                                Belum
                                            </label>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        <?php } ?>
                    </ul>   
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS Bundle (popper.js included) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>