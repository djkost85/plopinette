<script type="text/javascript" src="http://cdn.sublimevideo.net/js/2fsqewf8.js"></script>

<div id="actions">
	<div class="images">
		<a href="<?= img::get( 'video', $Video->image ) ?>" class="picture" rel="zoombox"><img class="poster" src="<?= img::get( 'video', $Video->image, 300, 400 ) ?>" /></a>
		<div id="preview" data-id="<?= $this->Video->id ?>">
			<img src="http://cf2.imgobject.com/t/p/original<?= $backdrops ?>" width="100%" />
	
			<div id="title">
				<h1><?= $Video->title ?> (<?= current( explode( '-', $this->Video->release ) ) ?>)</h1>
	
				<? if ( $Video->title != $Video->title_o ) : ?>
					<small><?= $Video->title_o ?></small>
				<? endif; ?>
	
				<div class="clear"></div>
			</div>
	
			<a id="play"<? if ( !user::is_login() ) : ?> class="facebook"<? endif; ?> href="<?= link::href( '/video/view/id:'.$Video->id.'/' ) ?>"></a>
		</div>
	
		<div class="clear"></div>
	</div>
	
	<div class="link">
		<ul>
			<li class="alert"><a href="<?= link::href( "alert/add/video_id:{$this->Video->id}" ) ?>"><? if ( !$alert_status ) : ?>La vidéo ne fonctionne pas<? else : ?>Retirer l'alerte<? endif ?></a></li>
			<li class="fb"><a href="#">Partager sur facebook</a></li>
				<li class="collection">
				<a href="#">Ajouter à une collection</a>
				<ul>
					<li><form method="post" action="<?= link::href( 'collection/add' ) ?>"><input type="text" name="collection[title]" value="" placeholder="Ajouter une collection" /><input type="submit" value="Créer" /></form></li>
					<? foreach ( array_reverse( user::get('collection') ) as $item ) : ?>
						<li<?= collection::has( $item->id, $this->Video->id ) ? ' class="selected"' : '' ?>><a data-id="<?= $item->id ?>" href="#"><?= $item->title ?></a></li>
					<? endforeach ?>
				</ul>
			</li>
			<li class="play"><a href="">Lire le film</a></li>
		</ul>
	</div>

	<div class="clear"></div>
</div>

<ul class="menu tab">
	<li class="current infos"><a data-tab="infos">Infos</a></li>
	<? if ( !empty( $Video->trailer ) ) : ?>
		<li class="trailer"><a data-tab="trailer">Bande annonce</a></li>
	<? endif; ?>

	<li class="similarity"><a data-tab="similarity">Similaires</a></li>
	<li class="comments"><a data-tab="comments"><fb:comments-count href=http://dailymatons.com<?= link::href( "video/infos/id:$Video->id/" ) ?>></fb:comments-count> Commentaires</a></li>
	<? /* ?><li class="buy"><a data-tab="buy">Investir</a></li><? */ ?>
	<? /* ?><li class="stats"><a data-tab="stats">Statistique</a></li> <? */ ?>

	<li class="right">
		<span class="icon view"><?= count( $Video->buy ) ?></span>

		<div class="clear"></div>
	</li>

	<div class="clear"></div>
</ul>

<div class="tab-content">
	<div class="tab infos current">
		<div class="allocine">
			<span class="duration">
				<label>Durée :</label>
				<span><?= $Video->duration ?></span>
			</span>

			<span class="release">
				<label>Date de sortie :</label>
				<span><?= date::convert( 'd F Y', $Video->release ) ?></span>
			</span>

			<span class="director">
				<label>Réalisateur :</label>
				<span>
					<? foreach ( $Video->directors as $i => $Item ) : ?>
						<a href="<?= link::href( "/director/id:{$Item->id}/" ) ?>"><?= $Item->firstname.' '.$Item->lastname ?></a><?= ( $i != count( $Video->directors ) - 1 ) ? ', ' : '' ?>
					<? endforeach; ?>
				</span>
			</span>

			<span class="actor">
				<label>Acteurs :</label>
				<span>
					<? foreach ( $Video->actors as $i => $Item ) : ?>
						<a href="<?= link::href( "/actor/id:{$Item->id}/" ) ?>"><?= $Item->firstname.' '.$Item->lastname ?></a><?= ( $i != count( $Video->actors ) - 1 ) ? ', ' : '' ?>
					<? endforeach; ?>
				</span>
			</span>

			<span class="genre">
				<label>Genre :</label>
				<span>
					<? foreach ( $Video->genres as $i => $Item ) : ?>
						<a href="<?= link::href( "/genre/view/id:{$Item->id}/" ) ?>"><?= $Item->title ?></a><?= ( $i != count( $Video->genres ) - 1 ) ? ', ' : '' ?>
					<? endforeach; ?>
				</span>
			</span>

			<span class="lang">
				<label>Langue :</label>
				<span>
					<? foreach ( $Video->langs as $i => $Item ) : ?>
						<a href="<?= link::href( "/lang/id:{$Item->id}/" ) ?>"><?= $Item->title ?></a><?= ( $i != count( $Video->langs ) - 1 ) ? ', ' : '' ?>
					<? endforeach; ?>
				</span>
			</span>

			<span class="abstract">
				<label>Synopsys :</label>
				<span><?= $Video->abstract ?></span>
			</span>
		</div>

		<div class="clear"></div>
	</div>

	<? if ( !empty( $Video->trailer ) ) : ?>
		<div class="tab trailer">
			<div style='width:700px; height:243px'><object width='100%' height='100%'><param name='movie' value='<?= $Video->trailer ?>'></param><param name='allowFullScreen' value='true'></param><param name='allowScriptAccess' value='always'></param><embed src='<?= $Video->trailer ?>' type='application/x-shockwave-flash' width='100%' height='100%' allowFullScreen='true' allowScriptAccess='always'/></object></div>
		</div>
	<? endif; ?>

	<div class="tab similarity">
		similarity
	</div>

	<div class="tab comments">
		<div class="fb-comments" data-href="http://dailymatons.com<?= link::href( "video/infos/id:$Video->id/" ) ?>" data-num-posts="30" data-width="470"></div>
	</div>
<? /* ?>
	<div class="tab buy">
		<h2>Fonctionnalité encore en développement</h2>
		<a href="<?= link::href( 'bet', 'add', array( 'video_id' => $Video->id ) ) ?>">Parier sur ce film ( <?= count( $Video->bet ) ?> )</a>
	</div>
<? */ ?>
<? /* ?>
	<div class="tab stats">
		<? foreach ( $stats as $day => $count ) : ?>
			<!--<div class="stat" style="height: <?= ( $count * 100 / $max_stats ) ?>%; width: <?= ( 100 / count( $stats ) ) ?>%;"><?= $count ?></div>-->
			<div class="stat" style="width: <?= ( 100 / count( $stats ) ) ?>%;">
				<span class="date"><?= $day ?></span>
				<span class="count" style="height: <?= ( $count * 100 / $max_stats ) ?>%;"><?= $count ?></span>
			</div>
		<? endforeach; ?>

		<div class="clear"></div>
	</div>
<? */ ?>
</div>

<script	type="text/javascript">
	$(document).ready(function(){
		zoombox.init();
	});
</script>

<script	type="text/javascript">
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1&appId=200606866671822";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>