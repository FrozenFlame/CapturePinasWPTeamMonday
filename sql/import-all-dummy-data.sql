USE capturepinas;

INSERT INTO users (i1, username, fullname, email, password, activated) VALUES
(NULL, 'adversario', 'Greg Marvin Adversario', 'adversario@gmail.com', 'adversario123', 'TRUE'),
(NULL, 'arsenio', 'Reymark Arsenio', 'arsenio@gmail.com', 'arsenio123', 'TRUE'),
(NULL, 'cabangon', 'Joshua Cabangon', 'cabangon@gmail.com', 'cabangon123', 'FALSE'),
(NULL, 'catalan', 'Celine Catalan', 'catalan@gmail.com', 'catalan123', 'True'),
(NULL, 'deogracias', 'Denzel Deogracias', 'deogracias@gmail.com', 'deogracias123', 'TRUE')
;

INSERT INTO post (postid, userid, title, place, isMedia, description, likes, dislikes, favnum, timestamp) VALUES
    (NULL, 1, "Adversario title", "adversario place", "TRUE", "description ni greg", 3, 1 , 1 , "13:01 8/11/2011"),
    (NULL, 2, "Arsenio title", "arsenio place", "FALSE", "arsenio no description", 1, 2, 3, "6:56 10/11/2012"),
    (NULL, 3, "Cabangon title", "cabangon place", "FALSE", "The FitnessGram Pacer Test
     is a multistage aerobic capacity test that progressively gets more difficult as it continues.
     The 20 meter pacer test will begin in 30 seconds. Line up at the start. The running speed
     starts slowly but gets faster each minute after you hear this signal bodeboop. A sing lap
     should be completed every time you hear this sound. ding Remember to run in a straight line
     and run as long as possible. The second time you fail to complete a lap before the sound,
     your test is over. The test will begin on the word start. On your mark. Get ready!… Start. ding﻿", 5, 0, 5, "23:24 3/2/2001"),
    (NULL, 4, "Catalan post1", "catalan place1", "True", "halp", 4, 1, 2, "24:60 13/32/2018"),
    (NULL, 4, "Catalan post2", "catalan place2", "TRUE", "mercedes bench", 3, 2, 1, "1:23 1/2/2003")
;

INSERT INTO postcomments (postid, userid, content, likes, dislikes, timestamp) VALUES
    (1, 1, "userid1 comments on postid1", 1 , 1, "13:01 8/11/2011"),
    (3, 2, "userid2 comments on postid3", 2, 3, "6:56 10/11/2012"),
    (3, 3, "userid3 comments on postid3", 0, 5, "23:24 3/2/2001"),
    (2, 4, "userid4 comments on postid2", 1, 2, "24:60 13/32/2018"),
    (5, 4, "userid4 comments on postid5", 2, 1, "1:23 1/2/2003")
;

INSERT INTO postmedia (postid, filepath) VALUES
    (1, "/CapturePinasWPTeamMonday/postimages/p1img"),
    (4, "/CapturePinasWPTeamMonday/postimages/p4img"),
    (5, "/CapturePinasWPTeamMonday/postimages/p5img")
;

INSERT INTO userinfo (id, filepath, bio) VALUES
    (1, "/CapturePinasWPTeamMonday/userimages/default", "Hi im greg"),
    (2, "/CapturePinasWPTeamMonday/userimages/u2img3", "jarvs is here"),
    (3, "/CapturePinasWPTeamMonday/userimages/u3img1", "plus ultra!"),
    (4, "/CapturePinasWPTeamMonday/userimages/default", "eksdi"),
    (5, "/CapturePinasWPTeamMonday/userimages/u5img6", "ez dogs")
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
