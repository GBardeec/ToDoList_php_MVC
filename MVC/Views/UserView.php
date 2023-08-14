<?php include("MVC/views/layouts/header.php"); ?>
    <main>
        <?php if (!isset($_SESSION['login'])): ?>
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Поле авторизации/регистрации</h5>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="/login">
                            <div class="row mb-3">
                                <label for="login" class="col-md-4 col-form-label text-md-end">Имя пользователя</label>

                                <div class="col-md-6">
                                    <input id="login" type="text" class="form-control" name="login" autocomplete="email"
                                           autofocus required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control"
                                           name="password" required autocomplete="current-password">
                                    <small id="emailHelp" class="form-text text-muted">Если у вас отсутствует аккаунт -
                                        он будет автоматически создан</small>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-secondary">
                                    Войти
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center">Вы уже авторизованы</a></p>
        <?php endif; ?>
    </main>
<?php include("MVC/views/layouts/footer.php"); ?>