<?php
require 'database/dbconfig.php';
$db = new DatabaseConnection();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Game Distribution | Platforms</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>


        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.php" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>GameDistro</h3>
                </a>
                
                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Companies</a>
                    <a href="stores.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Stores</a>
                    <a href="platforms.php" class="nav-item nav-link active"><i class="fa fa-keyboard me-2"></i>Platforms</a>
                    <a href="games.php" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Games</a>
                    <a href="supports.php" class="nav-item nav-link"><i class="fa fa-headset me-2"></i>Supports</a>
                    <a href="gamers.php" class="nav-item nav-link"><i class="fa fa-user me-2"></i>Gamers</a>
                </div>
            </nav>
        </div>


        <div class="content">
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                
            </nav>

            <div class="container-fluid pt-4 px-4">
                <div class="bg-light text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Listing of all platforms</h6>
                    </div>
                    <div class="mb-3 d-flex justify-content-start">
                        <button onclick="openModal('add')" class="btn btn-sm btn-primary">Add Platform</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Name</th>
                                    <th scope="col">Manufacturer</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT * FROM Platform;";
                            $statement = $db->query($sql);

                            if ($statement->rowCount() > 0) {
                                $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($rows as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['Name'] ?></td>
                                        <td><?php echo $row['Manufacturer'] ?></td>
                                        <td><?php echo $row['Type'] ?></td>
                                        <td>
                                            <button onclick="openModal('update',<?= $row['PlatformID'] ?>)" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                                            <button onclick="deletePlatform(<?= $row['PlatformID'] ?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td class="text-center" colspan="4">No platforms</td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="index.php">Game Distribution</a>, All Right Reserved.
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="platformModal" tabindex="-1" aria-labelledby="platformModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="platformModalLabel">Manage Platform</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="platformForm">
                        <input type="hidden" id="platformId">
                        <div class="mb-3">
                            <label for="platformName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="platformName" required>
                        </div>
                        <div class="mb-3">
                            <label for="platformManufacturer" class="form-label">Manufacturer</label>
                            <input type="text" class="form-control" id="platformManufacturer" required>
                        </div>
                        <div class="mb-3">
                            <label for="platformType" class="form-label">Type</label>
                            <select class="form-control" name="platformType" id="platformType" required>
                                <option value="Console">Console</option>
                                <option value="PC">PC</option>
                                <option value="Mobile">Mobile</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="savePlatform()">Save Changes</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function openModal(mode, platformId = null) {
            // Clear form data
            document.getElementById('platformId').value = '';
            document.getElementById('platformName').value = '';
            document.getElementById('platformType').value = '';
            document.getElementById('platformManufacturer').value = '';

            if (mode !== 'add') {
                fetch(`api/platform.php?action=get&platformId=${platformId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('platformId').value = data.PlatformID;
                        document.getElementById('platformName').value = data.Name;
                        document.getElementById('platformType').value = data.Type;
                        document.getElementById('platformManufacturer').value = data.Manufacturer;
                        $('#platformModal').modal('show');
                    });
            }else {
                document.getElementById('platformType').value = 'Console';
                $('#platformModal').modal('show');
            }
        }

        function savePlatform() {
            const platformId = document.getElementById('platformId').value;
            const name = document.getElementById('platformName').value;
            const type = document.getElementById('platformType').value;
            const manufacturer = document.getElementById('platformManufacturer').value;
            const action = platformId ? 'update' : 'add';

            fetch('api/platform.php?action=' + action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ platformId, name, type, manufacturer })
            })
                .then(response => response.json())
                .then(data => {
                    $('#platformModal').modal('hide');
                    window.location.reload()
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred');
                });
        }

        function deletePlatform(platformId) {
            if (confirm('Are you sure you want to delete this platform?')) {
                fetch('api/platform.php?action=delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ platformId })
                })
                    .then(response => response.json())
                    .then(data => {
                        window.location.reload()
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred');
                    });
            }
        }

    </script>
</body>

</html>