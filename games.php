<?php
require 'database/dbconfig.php';
$db = new DatabaseConnection();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Game Distribution | Games</title>
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
                    <a href="platforms.php" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Platforms</a>
                    <a href="games.php" class="nav-item nav-link active"><i class="fa fa-table me-2"></i>Games</a>
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
                        <h6 class="mb-0">Listing of all games</h6>
                    </div>
                    <div class="mb-3 d-flex justify-content-start">
                        <button onclick="openModal('add')" class="btn btn-sm btn-primary">Add Game</button>
                    </div>
                    <form method="post">
                        <?php
                        $titleSearch = '';
                        $genreSearch = '';
                        $priceSearch = '';
                        if(isset($_POST['search-btn'])){
                            $titleSearch = $_POST['titleSearch'];
                            $genreSearch = $_POST['genreSearch'];
                            $priceSearch = $_POST['priceSearch'];
                        }
                        ?>
                        <div class="row mb-4">
                            <div class="col-3">
                                <div class="col-12">
                                    <input type="text" id="titleSearch" name="titleSearch" value="<?= $titleSearch ?>" class="form-control" placeholder="Search by Title" />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="col-12">
                                    <input type="text" id="genreSearch" name="genreSearch" value="<?= $genreSearch ?>" class="form-control" placeholder="Search by Genre" />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="col-12">
                                    <input type="text" id="priceSearch" name="priceSearch" value="<?= $priceSearch ?>" class="form-control" placeholder="Search by Price" />
                                </div>
                            </div>
                            <div class="col-3">
                                <button type="submit" name="search-btn" class="btn btn-primary w-75">Search</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">Title</th>
                                    <th scope="col">Genre</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Publisher</th>
                                    <th scope="col">Age Rating</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT Game.*, Company.Name FROM Game join Company on Game.PublisherID = Company.CompanyID";
                            if(isset($_POST['search-btn'])){
                                $sql .= " WHERE Game.Title LIKE '%$titleSearch%' AND Game.Genre LIKE '%$genreSearch%'";
                                if(!empty($priceSearch)){
                                    $sql .= " AND Game.Price = '$priceSearch'";
                                }
                            }
                            $statement = $db->query($sql);
                            if ($statement->rowCount() > 0) {
                                $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($rows as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['Title'] ?></td>
                                        <td><?php echo $row['Genre'] ?></td>
                                        <td><?php echo $row['Price'] ?></td>
                                        <td><?php echo $row['Name'] ?></td>
                                        <td><?php echo $row['AgeRating'] ?></td>
                                        <td>
                                            <button onclick="openModal('update',<?= $row['GameID'] ?>)" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></button>
                                            <button onclick="deleteGame(<?= $row['GameID'] ?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>
                                        </td>
                                    </tr>
                                <?php }
                            } else { ?>
                                <tr>
                                    <td class="text-center" colspan="6">No games</td>
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
    <div class="modal fade" id="gameModal" tabindex="-1" aria-labelledby="gameModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gameModalLabel">Manage Game</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="gameForm">
                        <input type="hidden" id="gameId">
                        <div class="mb-3">
                            <label for="gameTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="gameTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="gameGenre" class="form-label">Genre</label>
                            <input type="text" class="form-control" id="gameGenre" required>
                        </div>
                        <div class="mb-3">
                            <label for="gamePrice" class="form-label">Price</label>
                            <input type="number" min="0" class="form-control" id="gamePrice" required>
                        </div>
                        <div class="mb-3">
                            <label for="gameAgeRating" class="form-label">Type</label>
                            <select class="form-control" name="gameAgeRating" id="gameAgeRating" required>
                                <option value="Everyone">Everyone</option>
                                <option value="Everyone10+">Everyone10+</option>
                                <option value="Teen">Teen</option>
                                <option value="Mature17+">Mature17+</option>
                                <option value="AdultsOnly">AdultsOnly</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="gamePublisher" class="form-label">Publisher</label>
                            <select class="form-control" name="gamePublisher" id="gamePublisher" required>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveGame()">Save Changes</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        function openModal(mode, gameId = null) {
            // Clear form data
            document.getElementById('gameId').value = '';
            document.getElementById('gameTitle').value = '';
            document.getElementById('gameGenre').value = '';
            document.getElementById('gamePrice').value = '';
            document.getElementById('gameAgeRating').value = '';
            document.getElementById('gamePublisher').value = '';

            document.getElementById('gamePublisher').innerHTML = '';

            fetch(`api/game.php?action=companies`)
                .then(response => response.json())
                .then(companiesList => {

                    companiesList.forEach(company => {
                        document.getElementById('gamePublisher').innerHTML += `<option value="${company.CompanyID}">${company.Name}</option>`
                    })

                    if (mode !== 'add') {
                        fetch(`api/game.php?action=get&gameId=${gameId}`)
                            .then(response => response.json())
                            .then(data => {
                                document.getElementById('gameId').value = data.GameID;
                                document.getElementById('gameTitle').value = data.Title;
                                document.getElementById('gameGenre').value = data.Genre;
                                document.getElementById('gamePrice').value = data.Price;
                                document.getElementById('gameAgeRating').value = data.AgeRating;
                                document.getElementById('gamePublisher').value = data.CompanyID;
                                $('#gameModal').modal('show');
                            });
                    }else {
                        document.getElementById('gameAgeRating').value = 'Everyone';
                        document.getElementById('gamePublisher').value = companiesList?.length > 0 ? companiesList[0].CompanyID : '';
                        $('#gameModal').modal('show');
                    }

                });

        }

        function saveGame() {
            const gameId = document.getElementById('gameId').value;
            const title = document.getElementById('gameTitle').value;
            const genre = document.getElementById('gameGenre').value;
            const price = document.getElementById('gamePrice').value;
            const rating = document.getElementById('gameAgeRating').value;
            const publisher = document.getElementById('gamePublisher').value;
            const action = gameId ? 'update' : 'add';

            fetch('api/game.php?action=' + action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ gameId, title, genre, price, rating, publisher })
            })
                .then(response => response.json())
                .then(data => {
                    $('#gameModal').modal('hide');
                    window.location.reload()
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred');
                });
        }

        function deleteGame(gameId) {
            if (confirm('Are you sure you want to delete this game?')) {
                fetch('api/game.php?action=delete', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ gameId })
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