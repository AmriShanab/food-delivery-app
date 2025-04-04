<?php
require_once '../includes/auth.php';
require_once '../includes/header.php';
// adminAuth();
?>

<div class="container-fluid">
    
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <br><br><br><br><br>
        <h1 class="h2">Restaurants</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="create.php" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-plus"></i> Add New Restaurant
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="restaurantsTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $restaurants = $db->query("SELECT * FROM restaurants ORDER BY name")->fetchAll();
                        
                        foreach ($restaurants as $restaurant):
                        ?>
                        <tr>
                            <td><?= $restaurant['id'] ?></td>
                            <td><?= htmlspecialchars($restaurant['name']) ?></td>
                            <td>
                                <?php if ($restaurant['image']): ?>
                                <img src="../../assets/images/<?= $restaurant['image'] ?>" width="50" height="50" class="img-thumbnail">
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($restaurant['address']) ?></td>
                            <td><?= htmlspecialchars($restaurant['city']) ?></td>
                            <td><?= htmlspecialchars($restaurant['telephone_no']) ?></td>
                            <td>
                                <a href="edit.php?id=<?= $restaurant['id'] ?>" class="btn btn-sm btn-outline-primary">Edit
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="delete.php?id=<?= $restaurant['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                    Delete<i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
