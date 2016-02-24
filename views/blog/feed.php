<?php use yii\helpers\Url; ?>
<?xml version="1.0" encoding="UTF-8"?>
<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
	><channel>
	<title>枕边书</title>
	<atom:link href="http://www.alwayscoding.cn/feed.xml" rel="self" type="application/rss+xml" />
	<link>http://www.alwayscoding.cn</link>
	<description>枕边书 -- 常怀敬畏之心</description>
	<language>en</language>
	<sy:updatePeriod>hourly</sy:updatePeriod>
	<sy:updateFrequency>1</sy:updateFrequency>
	<generator>http://www.alwayscoding.cn/</generator>
	<xhtml:meta xmlns:xhtml="http://www.w3.org/1999/xhtml" name="robots" content="noindex" />
	<?php foreach ($res as $article): ?>
		<item>
			<title><?=$article->title ?></title>
			<link><?=Url::to(['article/detail'])."?id=".$article->id ?></link>
			<pubDate><?= date('Y-m-d H:i:s',$article->pubtime)?></pubDate>
			<dc:creator>枕边书</dc:creator>
			<category><![CDATA[<?=$article->menu->name ?>]]></category>
			<description><![CDATA[<?=$article->abstract ?>]]></description>
			<content:encoded><![CDATA[<?=$article->abstract ?><a href="<?=Url::to(['article/detail'])."?id=".$article->id ?>" target="_blank">阅读更多</a>]]></content:encoded>
			<wfw:commentRss>http://www.alwayscoding.cn/feed.xml</wfw:commentRss>
			<slash:comments>0</slash:comments>
		</item>
	<?php endforeach ?>
	</channel>
</rss>