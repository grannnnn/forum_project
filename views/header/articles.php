<!--Центральная часть сайта-->
	<div class=main-contaner>
		<main id=content>
			<?php
			for ($i = $GetPg['a_s']; $i < $GetPg['a_f']; $i++){
				if ($i == $GetPg['a_max']) break;
				$row = mysqli_fetch_assoc($query);
				$datem = getDateForBD($row['date']);
				if (isset($_SESSION['id'])&&$_SESSION['login'] == "admin"||$_SESSION['login']==$row['user_name']){
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
						<p class = "article-text">'.$row['text'].'</p>
						<footer class="article-foot_u">
						<p style = "color:black;" class="author-article">Автор: '.$row['author'].'</p>
							<a class="article-open-button article-u-button" id = "but" href="/article/open/'.$row['id_ar'].'/">Открыть</a>
							 <a class="article-open-button article-u-button" id = "but" href="/article/delete/'.$row['id_ar'].'/">Удалить</a>
							 <a class="article-open-button article-u-button" id = "but" href="/article/edit/'.$row['id_ar'].'/">Редактировать</a>

						</footer>
					</article>';
				}
				else {
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
						<footer class="article-foot">
							 <p style = "color:black;" class="author-article">Автор: '.$row['user_name'].'</p>
								 <a class="article-open-button article-u-button" id = "but" href="/article/open/'.$row['id'].'/">Открыть</a>
						</footer>
					</article>';
				}

			}

			if($GetPg['pa_max']>1){
				echo '<h1 id = "h1_page" >';
				for ($i=1; $i <= $GetPg['pa_max']; $i++) {
					echo '<a id = "page" href="/main/'.($i-1).'/">'.$i.'</a>';
				}
				echo "</h1>";
			}


			?>
		</main>
