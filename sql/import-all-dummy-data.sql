USE capturepinas;

INSERT INTO users (id, username, fullname, email, password, activated) VALUES
(NULL, 'adversario', 'Greg Marvin Adversario', 'adversario@gmail.com', 'adversario123', 'TRUE'),
(NULL, 'arsenio', 'Reymark Arsenio', 'arsenio@gmail.com', 'arsenio123', 'TRUE'),
(NULL, 'cabangon', 'Joshua Cabangon', 'cabangon@gmail.com', 'cabangon123', 'FALSE'),
(NULL, 'catalan', 'Celine Catalan', 'catalan@gmail.com', 'catalan123', 'True'),
(NULL, 'deogracias', 'Denzel Deogracias', 'deogracias@gmail.com', 'deogracias123', 'TRUE')
;

INSERT INTO post (postid, userid, title, place, isMedia, description, likes, dislikes, favnum, timestamp) VALUES
    (NULL, 1, "Don't wanna go home'", "Albay", "TRUE", "Guys I swear there isn't a better place than this!", 3, 1 , 1 , "13:01 8/11/2011"),
    (NULL, 2, "Another day on vacay", "Palawan", "FALSE", "Grabe guys, this place is the best. 
    Thank goodness I decided to go here", 1, 2, 3, "6:56 10/11/2012"),
    (NULL, 3, "No TRyhards here", "Laoag", "FALSE", "I went here for the bonus checks.", 5, 0, 5, "23:24 3/2/2001"),
    (NULL, 4, "Catalan Islands they should rename this place", "Boracay", "True", "For real my friends this is not suitable.", 4, 1, 2, "24:60 13/32/2018"),
    (NULL, 4, "I'm lost help please", "Mt. Diwata", "TRUE", "No kidding like I'm legit lost", 35, 2, 1, "1:23 1/2/2003")
;

INSERT INTO postcomments (postid, userid, content, likes, dislikes, timestamp) VALUES
    (1, 1, "No kidding", 1 , 1, "13:01 8/11/2011"),
    (3, 2, "Yo, this place is clean.", 2, 3, "6:56 10/11/2012"),
    (3, 3, "No it isn't'", 0, 5, "23:24 3/2/2001"),
    (2, 4, "This place can only get better, you guys know that", 1, 2, "24:60 13/32/2018"),
    (5, 4, "Yeah sure but as it stands there's not much going on here.", 2, 1, "1:23 1/2/2003")
;

INSERT INTO postmedia (postid, filepath) VALUES
    (1, "/CapturePinasWPTeamMonday/postimages/p1img"),
    (4, "/CapturePinasWPTeamMonday/postimages/p4img"),
    (5, "/CapturePinasWPTeamMonday/postimages/p5img")
;

INSERT INTO userinfo (id, filepath, bio) VALUES
    (1, "/CapturePinasWPTeamMonday/images/avatars/default.png", "Hi im greg"),
    (2, "/CapturePinasWPTeamMonday/images/avatars/default.png", "jarvs is here"),
    (3, "/CapturePinasWPTeamMonday/images/avatars/default.png", "plus ultra!"),
    (4, "/CapturePinasWPTeamMonday/images/avatars/default.png", "eksdi"),
    (5, "/CapturePinasWPTeamMonday/images/avatars/denzelAvatar.png", "ez dogs")
;

INSERT INTO userfav (id, postid) VALUES
    (1, 2),
    (1, 4),
    (1, 3),
    (2, 3),
    (3, 2),
    (3, 1),
    (1, 5),
    (2, 2),
    (5, 2)

;
