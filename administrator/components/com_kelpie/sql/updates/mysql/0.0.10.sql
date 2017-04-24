DROP TABLE IF EXISTS #__kp_video;
DROP TABLE IF EXISTS #__kp_category;
DROP TABLE IF EXISTS #__kp_player;
DROP TABLE IF EXISTS #__kp_rating;
DROP TABLE IF EXISTS #__kp_likes_dislikes;


CREATE TABLE #__kp_video (
	id       INT(11)     NOT NULL AUTO_INCREMENT,
	title_video 	 VARCHAR(255) NOT NULL,
	text_video	 longtext,
	content_image longtext,
	type_video 	tinyint(3),
	url_video longtext,
	url_hd_video longtext,
	thumb_video longtext,
	preview_video longtext,
	published tinyint(4) NOT NULL,
	created datetime,
	state tinyint(3),
	publish_up datetime,
	publish_down datetime,
	alias varchar(400),
	featured tinyint(3),
	catid	    INT(11)    NOT NULL DEFAULT '0',
	vote_good INT(11)    NOT NULL DEFAULT '0',
	vote_bad INT(11)    NOT NULL DEFAULT '0',
	version int(10),
	PRIMARY KEY (id)
)

	ENGINE =MyISAM
	AUTO_INCREMENT =201700000
	DEFAULT CHARSET =utf8;

	INSERT INTO #__kp_video (title_video) VALUES
('Naruto Shippuden Episode 200'),
('One Piece  Episode 30');


CREATE TABLE #__kp_category (

	id INT(11) NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	slug VARCHAR(255) NOT NULL,
	parent INT(11) NOT NULL DEFAULT '0',
	type VARCHAR(255) NOT NULL,
	access VARCHAR(255) NOT NULL,
	ordering INT(11) NOT NULL DEFAULT '0',
	metakeywords text,
	metadescription text,
	published tinyint(4) NOT NULL,
	PRIMARY KEY (id)
	

)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

	INSERT INTO #__kp_category (name) VALUES ('Default');



CREATE TABLE #__kp_player (

	id INT(11) NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	slug VARCHAR(255) NOT NULL,
	width INT(5) NOT NULL ,
	height INT(5) NOT NULL ,
	looop tinyint(4),
	autostart tinyint(4),
	buffer INT(2) NOT NULL,
	volumelevel int(2) NOT NULL,
	stretch	varchar(10) NOT NULL,
	controlbar	tinyint(4) NOT NULL,
	playlist	tinyint(4)	NOT NULL,
	durationdock	tinyint(4) NOT NULL,
	timerdock	tinyint(4) NOT NULL,
	fullscreendock	tinyint(4) NOT NULL,
	hddock	tinyint(4) NOT NULL,
	embeddock	tinyint(4) NOT NULL,
	facebookdock	tinyint(4) NOT NULL,
	twitterdock	tinyint(4) NOT NULL,
	controlbaroutlinecolor	varchar(10)	NOT NULL,
	controlbarbgcolor	varchar(10)	NOT NULL,
	controlbaroverlaycolor	varchar(10)	NOT NULL,
	controlbaroverlayalpha	int(3)NOT NULL,
	iconcolor	varchar(10)	NOT NULL,
	progressbarbgcolor	varchar(10)	NOT NULL,
	progressbarbuffercolor	varchar(10)	NOT NULL,
	progressbarseekcolor	varchar(10)	NOT NULL,
	volumebarbgcolor	varchar(10)	NOT NULL,
	volumebarseekcolor	varchar(10)	NOT NULL,
	playlistbgcolor	varchar(10) NOT NULL DEFAULT '0x000000',
	customplayerpage	varchar(255)	NOT NULL,
	preroll	tinyint(4) NOT NULL,
	postroll	tinyint(4)NOT NULL,
	type	varchar(25)	NOT NULL DEFAULT 'flash',
	published tinyint(4) NOT NULL,
	PRIMARY KEY (id)
	

)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

	INSERT INTO #__kp_player (name) VALUES('Default');
	
	

CREATE TABLE #__kp_rating (

	id INT(11) NOT NULL AUTO_INCREMENT,
	userid	int(5) NOT NULL,
	sessionid	varchar(50) NOT NULL,
	videoid	int(5) NOT NULL,
	rating	float(2,1) NOT NULL,
	ordering INT(11) NOT NULL DEFAULT '0',
	metakeywords text,
	metadescription text,
	published tinyint(4) NOT NULL,
	PRIMARY KEY (id)
	

)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

	INSERT INTO #__kp_rating (videoid, rating) VALUES (1, 2.5);
	
CREATE TABLE #__kp_likes_dislikes (

	id INT(11) NOT NULL AUTO_INCREMENT,
	userid	int(5) NOT NULL,
	sessionid	varchar(50) NOT NULL,
	videoid	int(5) NOT NULL,
	likes	int(5) NOT NULL,
	dislikes int(5) NOT NULL,
	ordering INT(11) NOT NULL DEFAULT '0',
	metakeywords text,
	metadescription text,
	published tinyint(4) NOT NULL,
	PRIMARY KEY (id)
	

)
	ENGINE =MyISAM
	AUTO_INCREMENT =0
	DEFAULT CHARSET =utf8;

	INSERT INTO #__kp_likes_dislikes (videoid, likes) VALUES (1,1);	