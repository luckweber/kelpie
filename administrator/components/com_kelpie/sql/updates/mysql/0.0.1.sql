DROP TABLE IF EXISTS #__kp_video;
DROP TABLE IF EXISTS #__kp_category;


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

	INSERT INTO #__kp_category (name) VALUES
('Naruto Shippuden'),
('One Piece');

