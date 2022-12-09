<div class=main-contaner>
  <div class="">
    <?php

    function getMouthName($m){
      $rusMonthNames = [
        '01' => 'Янв',  '02' => 'Фев',  '03' => 'Мар',  '04' => 'Апр',   '05' => 'Май',
        '06' => 'Июн',  '07' => 'Июл',  '08' => 'Авг',  '09' => 'Сен',
        '10' => 'Окт',  '11' => 'Ноя',  '12' => 'Дек'];
        return $rusMonthNames[$m];
    }

    function getDateForBD($date){
      $datem = explode("-", $date);
      $datem[1] = getMouthName($datem[1]);
      return $datem;
    }

    if(!isset($_SESSION['id']))
    echo '<p class = "about all_box">Тут могли располагаться ваши статьи. Войдите чтобы начать!</p>';

    else {
      if(isset($_GET["page"])) $u_page = $_GET["page"]; else $u_page=0;

      //считаем сначала кол-во статей в базе, которые написал пользователь
      $rez = $mysqli->query("SELECT COUNT(*) as art_count FROM article WHERE author = '$_SESSION[login]'");
      $u_a_max = $rez->fetch_object()->art_count;
      $rez->free();

      echo '<a style="bottom: 10px;" class="art-create article-open-button article-u-button" href="index.php?p=article_add">Создать статью</a>';
      if ($u_a_max>0){
        //кол-во статей на главном экране, которые написал пользователь
        if (!isset($_SESSION['id'])) $u_a_u = 5; else $u_a_u = $_SESSION['a_u'];

        //рассчитываем кол-во страниц
        $u_pa_max = ceil($u_a_max/$u_a_u);
        $u_a_s = 1 + $u_page * $u_a_u;
        $u_a_f = $u_a_u +  $u_page;

        //достаем статьи из базы
        $query = $mysqli->query("SELECT * FROM article WHERE author = '$_SESSION[login]' LIMIT $u_page,$u_a_u");
        //if (!isset($_SESSION['id'])){
          for ($i = $u_a_s; $i <= $u_a_f; $i++){
            $row = mysqli_fetch_assoc($query);
            $datem = getDateForBD($row['date']);
            echo
            '<article>
              <header class="article-head">
                <div class = "time">
                  <div class = year>'.$datem[0].'</div>
                  <div class = date>'.$datem[1].'<span>'.$datem[2].'</span></div>
                </div>
                 <h2>'.$row['title'].'</h2>
                 <button type=button class="article-button" onclick="delArticle(1)">'.$row['comment'].'</button>
              </header>
              <p>'.$row['text'].'</p>
              <footer class="article-foot_u">
                  <a class="article-open-button article-u-button" id = "but" href="index.php?p=article&id_art='.$row['id_ar'].'">Открыть статью</a>
                 <a class="article-open-button article-u-button" id = "but" href="index.php?p=article_del&id_art='.$row['id_ar'].'">Удалить</a>
                 <a class="article-open-button article-u-button" id = "but" href="index.php?p=article_edit&id_art='.$row['id_ar'].'">Редактировать</a>

              </footer>
            </article>';
            if ($i == $u_a_max) break;
          }
          if($u_pa_max>1){
            echo "<h1>";
            for ($i=1; $i <=$u_pa_max ; $i++) {
              echo '<a href=index.php?p=portfolio&page='.($i-1).'>'.$i.'</a>';
            }
            echo "</h1>";
          }
      }
    else {
    echo '<p class = "about all_box">Тут могли располагаться ваши статьи. Создайте!!</p>';
    }


    }
     ?>
  </div>
