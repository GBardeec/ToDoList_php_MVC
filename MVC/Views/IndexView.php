<?php include("MVC/views/layouts/header.php"); ?>
    <main>
        <div class="container">
            <?php if (isset($_SESSION['login'])): ?>
                <div class="row justify-content-center">
                    <form class="col-4" method="POST" name="tasksform" action="/addTask">
                        <h5 class="text-center">Список неподтвержденных задач</h5>
                        <div class="input-group mb-3">
                            <input type="text" name="description" required class="form-control"
                                   placeholder="Введите текст" aria-describedby="basic-addon2">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['id']; ?>">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit">Добавить</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row justify-content-center">
                    <div class="col-4">
                        <div>
                            <div>
                                <?php
                                require_once('MVC/Controllers/TaskController.php');

                                $taskController = new TaskController();

                                $resultStatusNull = $taskController->getTasksWithStatusNull();
                                $resultStatusNotNull = $taskController->getTasksWithStatusNotNull();

                                if (!is_null($resultStatusNull)) {
                                    if (count($resultStatusNull) > 0) {
                                        echo "<ul class='list-group mb-3'>";
                                        foreach ($resultStatusNull as $row) {
                                            echo "<li class='list-group-item pt-1'>" . htmlspecialchars($row['description'],
                                                    ENT_QUOTES, 'UTF-8') . "</li>";
                                        }
                                        echo "</ul>";
                                        echo "<div class='btn-group d-flex justify-content-between'>";
                                            echo "<form method='POST' class='' action='/deleteAllTask'>";
                                                echo "<input type='submit' name='deleteAll' value='Удалить все' class='btn btn-danger mr-2'>";
                                            echo "</form>";
                                            echo "<form method='POST' class='' action='/changeStatusAllTask'>";
                                                echo "<input type='submit' name='readyAll' value='Подтвертить все' class='btn btn-success'>";
                                            echo "</form>";
                                        echo "</div>";
                                    } else {
                                        echo "<p class='text-center'>
                                                    <small>
                                                        Нет неподтвержденных задач
                                                    </small>
                                              </p>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-5">
                    <h5 class="text-center">Список подтвержденных задач</h5>
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <?php
                            if (count($resultStatusNotNull) > 0) {
                                echo "<ul class='list-group'>";
                                foreach ($resultStatusNotNull as $row) {
                                    $statusClass = $taskController->changeBackGroundColor($row);

                                    echo "<li class='list-group-item mt-3 " . $statusClass . "'>Задача: " . htmlspecialchars($row['description'],
                                            ENT_QUOTES, 'UTF-8') . "</li>";
                                    echo "<li class='list-group-item mb-1'>Статус: " . htmlspecialchars($row['status'],
                                            ENT_QUOTES, 'UTF-8') . "</li>";

                                    echo "<div class='btn-group d-flex justify-content-between'>";
                                        echo "<form method='POST' class='' action='/deleteOneTask'>";
                                            echo "<input type='hidden' name='taskId' value='" . $row['id'] . "'>";
                                            echo "<input type='submit' name='deleteOne' value='Удалить' class='btn btn-danger mr-2'>";
                                        echo "</form>";
                                        echo "<form method='POST' class='' action='/toggleStatus'>";
                                            echo "<input type='hidden' name='taskId' value='" . $row['id'] . "'>";
                                            echo "<input type='submit' name='toggleStatus' value='Изменить статус' class='btn btn-success'>";
                                        echo "</form>";
                                    echo "</div>";
                                }
                                echo "</ul>";
                            } else {
                                echo "<p class='text-center'>
                                        <small>
                                            Нет подтвержденных задач
                                        </small>
                                      </p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-center">Чтобы добавить задачу <a class="link-primary" href="/login">авторизуйтесь</a></p>
            <?php endif; ?>
        </div>
    </main>
<?php include("MVC/views/layouts/footer.php"); ?>