DROP TABLE IF EXISTS #__kp_video;


CREATE TABLE #__kp_video (
	id       INT(11)     NOT NULL AUTO_INCREMENT,
	title_video 	 VARCHAR(255) NOT NULL,
	text_video	 longtext,
	content_image longtext, 	
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
('Calmador Pescamor'),
('Poesias 2');
