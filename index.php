<?php
    $todolist = [];
    $host = 'devkinsta_db';
    $dbname = 'ToDoList';
    $dbuser = 'root';
    $dbpassword = 'GBhUwpF3t3QzDYbo';
    $database = new PDO(
        "mysql:host=$host;dbname=$dbname",
        $dbuser,
        $dbpassword
    );
    $sql = 'SELECT * FROM todolist';
    $query = $database->prepare($sql);
    $query->execute();
    $todolist = $query->fetchAll();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>TO DO App</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style type="text/css">
      body {
        background: #F1F1F1;
      }
    </style>
  </head>
  <body>
    <div
      class="card rounded shadow-sm"
      style="max-width: 500px; margin: 60px auto;"
    >
      <div class="card-body">
        <h3 class="card-title mb-3">My To do List</h3>
        <ul class="list-group">
        <?php foreach ($todolist as $todolists) { ?>
            <li
            class="list-group-item d-flex justify-content-between align-items-center"
          >
            <div>
            <form method="POST" action="completedtask.php">
                        <input
                            type="hidden"
                            name="completedtask"
                            value= "<?= $todolists["completed"]; ?>"
                            />
                          <input 
                            type="hidden"
                            name="deletetask"
                            value="<?= $todolists["id"]; ?>"
                            />
                            <?php
                              
                              if($todolists["completed"] == 1){
                                echo '<button class="btn btn-sm btn-success">'.'<i class="bi bi-check-square"></i>'.'</button>'.'<span class="ms-2 text-decoration-line-through">'.$todolists['task'].'</span>';
                              }else{
                                echo '<button class="btn btn-sm btn-light">'.'<i class="bi bi-square"></i>'.'</button>'.'<span class="ms-2  ">'.$todolists['task'].'</span>';
                              }
                            ?>
            </form>  
          </div>
            <div>
            <form method="POST" action="deletetask.php">
                        <input 
                            type="hidden"
                            name="deletetask"
                            value="<?= $todolists["id"]; ?>"
                            />
              <button class="btn btn-sm btn-danger">
                <i class="bi bi-trash"></i>
              </button>
              </form>
            </div>
          </li>
        <?php } ?>

        </ul>
        <div class="mt-4">
          <form method="POST" action="addtask.php" class="d-flex justify-content-between align-items-center">
            <input
              type="text"
              class="form-control"
              placeholder="Add new item..."
              name="task_name"
            />
            <button class="btn btn-primary btn-sm rounded ms-2">Add</button>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>


