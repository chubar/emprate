<?php

/**
 * рисуем юзерскую плашку с логином или форму логина
 * @param type $data
 */
function tp_user_show_login($data) {
    ?>
    <div class="user_show_login">
        <?php
        if (isset($data['authorized']) && $data['authorized']) {
            ?>
            <div class="plank">
                <a href="/profile">профиль <?php echo $data['first_name']; ?> <?php echo $data['last_name']; ?></a>
                <a href="/logout">выход</a>
                <?php if ($data['has_pic']) { ?>
                    <div class="photo">
                        <img src="<?php echo $data['pic_small']; ?>"></img>
                    </div>
                <?php } ?>
            </div>
            <?php
        } else {
            ?>
            <div class="form">
                <form method="post" action="/profile">
                    <input name="writemodule" value="auth" type="hidden" />
                    <input name="email" />
                    <input type="password" name="password" />
                    <input type="submit" value="log in" />
                </form>
                <?php
                if (isset($data['write']['auth'])) {
                    switch ($data['write']['auth']) {
                        case 'success':
                            break;
                        default:
                            ?>
                            <em>Неправильный email/пароль</em>
                            <?php
                            break;
                    }
                }
                ?>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}

/**
 * форма регистрации по email на разводной
 * @param type $data
 */
function tp_user_show_register_email_snippet($data) {
    ?>
    <div class="form">
        <form method="post">
            <input name="writemodule" value="register" type="hidden" />
            <input name="email" />
            <input type="password" name="password" />
            <input type="submit" value="register by corporation email" />
        </form>
    </div>
    <?php
}

/**
 * форма регистрации по инвайту на разводной
 * @param type $data
 */
function tp_user_show_register_invite_snippet($data) {
    ?>
    <div class="form">
        <form method="post">
            <input name="writemodule" value="register" type="hidden" />
            <input name="invite" />
            <input type="password" name="password" />
            <input type="submit" value="register by invite" />
        </form>
    </div>
    <?php
}

/**
 * при выходе юзера можно отрисовать "пока-пока"
 * @param type $data
 */
function tp_user_show_logout($data) {
    ?><?
}

/**
 * профиль пользователя
 */
function tp_user_show_profile($data) {
    if (!isset($data['id']))
        return;
    ?>
    <div class="profile">
        <h2>Профиль пользователя</h2>
        <?php if ($data['has_pic']) { ?>
            <div class="photo">
                <img src="<?php echo $data['pic_big']; ?>"></img>
            </div>
        <?php } ?>
        <?php if ($data['id'] == CurrentUser::$id) { ?>
            <a href="/profile/edit">редактировать</a>
        <?php } ?>
    </div>
    <?php
}

/**
 * редактирование своего профиля
 */
function tp_user_edit_profile($data) {
    if (!isset($data['id']))
        return;
    ?>
    <div class="edit_profile">
        <form method="post" enctype="multipart/form-data">
            <input name="writemodule" value="user" type="hidden" />
            <input name="action" value="edit" type="hidden" />
            <span>Фотография</span>
            <?php if ($data['has_pic']) { ?>
                <div class="photo">
                    <img src="<?php echo $data['pic_big']; ?>"></img>
                </div>
            <?php } ?>
            <div class="photo"></div>
            <div>
                <input type="file" name="photo" />
            </div>
            <span>Трудовой стаж</span>
            <div>
                <input type="submit" value="сохранить" />
            </div>
        </form>
    </div>
    <?php
}
