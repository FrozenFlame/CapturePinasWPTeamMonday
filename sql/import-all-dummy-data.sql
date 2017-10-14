USE capturepinas;

INSERT INTO users (id, username, fullname, email, password) VALUES
(NULL, 'GreekDiety1998', 'Greg Marvin Adversario', 'adversario@gmail.com', '$2y$10$sbWT5BxqlstdgMKY0hUuIeSyQ.WX0BizEpl0uMyEHCqXej6HpVIc.'),         -- non hashed 'goingPro'
(NULL, 'jarvis', 'Reymark Arsenio', 'arsenio@gmail.com', '$2y$10$EypZc/x87EMeHxYG1lyySOWZzdrsXCzk1hcO5QM6RpLNU/.Tnebzq'),                           -- non hashed 'warmachineroxx' 
(NULL, 'cKyuzee', 'Joshua Cabangon', 'cabangon@yahoo.com', '$2y$10$kQ2ww93xtbWHgf0tc4uh/.zaKNsjMiOhysS6OY9ZrGmCMJAKnH9J.'),                         -- non hashed 'tentacles'
(NULL, 'Catargaryen', 'Celine Catalan', 'catalan@gmail.com', '$2y$10$AEs3Hrpq2eHlZaouee1tN.ww0QNqBN6yFKWgiM2pXfcXFsFh84gjO'),                       -- non hashed 'catalan123'
(NULL, 'DD_', 'Denzel Deogracias', 'deogracias@gmail.com', '$2y$10$TP6JM3kIYqnRk41IcZNFP.RyIM.pOLIFTbEBwxSwAr2w2dElQ9wCe')                          -- non hashed 'ez_dogs'
;

INSERT INTO post (postid, userid, title, place, description, likes, dislikes, favnum, timestamp) VALUES 
    (NULL, 1, "Banaue of Painterly Dreams", "Banaue", "Because of its high altitude, Banaue is often described as
     \"where land merges with the clouds to meet the heavens\" with the rice terraces as \"the stairway to the sky.\" #RoadToTopPhotographerPH", 4, 0 , 2, "2016-08-11 13:01:20"),
    
    (NULL, 2, "Awesome Hills", "Bohol", "Chocolate Hills is a series of 1,268 perfectly symmetrical, haycock-shaped hills that rise some 30 meters above the ground.
     A National Geologic Monument, these unique, rock formations were cast after million years of evolution. #RoadToTopPhotographerPH #BeatThatGreg", 4, 1, 4, "2016-08-15 17:56:23"),
    
    (NULL, 1, "The Isle of Your Tropical Dreams", "Cebu", "Cebu is the traveler's fantasy of a tropical island come true - balmy weather,
     pristine beaches, crystalline waters, and luxurious resorts with all the frills of modern living.﻿", 3, 0, 1, "2017-01-16 14:24:18"),
    
    (NULL, 5, "Cool photo lol", "Camarines Sur", "Look at this little guy! Found him resting while we were walking", 3, 0, 3, "2017-01-22 08:14:18"),
    
    (NULL, 5, "HELP!", "Camarines Sur", "So I was trying to get this picture of a dragonfly,
     but then I tripped and fell on my camera! Now I need a new one! T_T", 0, 0, 0, "2017-01-22 08:24:38"),
    
    (NULL, 4, "\"The Last Frontier\"", "Palawan", "Guys punta kayo dito! Grabe ang ganda! Sama kayo sakin babalik ako dito <3", 4, 0, 4, "2017-02-03 22:04:16")
    
;

INSERT INTO postcomments (postid, userid, content, likes, dislikes, timestamp) VALUES 
    (1, 2, "Cool pictures bro!", 0, 1, "2016-08-11 13:21:53"),
    (1, 1, "They're called photos, \"bro\"", 1, 0, "2016-08-11 13:22:20"),
    (1, 3, "No need to be rude, dude", 1, 1, "2016-08-11 13:23:01"),    
    (1, 2, "Sorry, my bad bro! hahaha", 0, 0, "2016-08-11 13:23:43"),
    (1, 5, "@Joshua, I see what you did there LOL", 2, 0, "2016-08-11 13:25:32"),
    
    (2, 1, "Nice edits, dummy", 1, 2, "2016-08-15 17:56:44"),
    (2, 2, "LOL thanks bro!", 0, 1, "2016-08-15 17:57:07"),
    (2, 1, "That was sarcasm, idiot", 1, 3, "2016-08-15 17:57:12"),
    (2, 2, "Awww..", 0, 1, "2016-08-15 17:57:20"),

    (3, 1, "My best work so far! #Unedited", 1, 0, "2017-01-16 14:24:22"),
    (3, 1, "What, no comments yet? Guess people are afk", 1, 0, "2017-01-17 09:13:52"),
    (3, 1, "Yo I think this site's dead", 1, 0, "2017-01-19 08:14:22"),
    (3, 5, "Yo, parang blurred or low res yung mga nasa dulo bro", 1, 1, "2017-01-30 09:14:22"),
    (3, 5, "Parang yung lens mo lang brad, condolences \"bro\"", 1, 1, "2017-01-30 09:15:01"),
    
    
    (4, 2, "Cool photos bro!", 3, 0, "2017-01-22 08:20:19"),
    (4, 5, "LOL thanks bro!", 2, 0, "2017-01-22 08:20:48"),
    (4, 4, "Wow its so pretty!", 4, 0, "2017-01-22 16:21:18"),
    (4, 3, "Nice job dude! Oh, and condolence to your camera..", 1, 0, "2017-01-22 17:24:38"),    

    (5, 2, "Condolences, bro", 1, 1, "2017-01-22 08:24:58"),
    (5, 1, "Reasons", 1, 0, "2017-01-22 08:28:20"),        
    
    (6, 2, "Wow! Haha tara sama ako XD", 2, 0, "2017-02-03 23:14:22"),
    (6, 4, "Yun tara! Next week?", 2, 0, "2017-02-03 23:14:26"),
    (6, 2, "Gege pwede! hahaahha", 2, 0, "2017-02-03 23:14:32"),
    (6, 5, "I have no idea what you folks are talking about. Nice pics tho", 3, 0, "2017-02-04 09:34:26")
;


INSERT INTO postmedia (postid, filepath) VALUES 
    (1, "/CapturePinasWPTeamMonday/images/postimages/1img1.png"),
    (1, "/CapturePinasWPTeamMonday/images/postimages/1img2.png"),
    (1, "/CapturePinasWPTeamMonday/images/postimages/1img3.png"),
    (1, "/CapturePinasWPTeamMonday/images/postimages/1img4.png"),
    
    (2, "/CapturePinasWPTeamMonday/images/postimages/2img1.png"),
    (2, "/CapturePinasWPTeamMonday/images/postimages/2img2.png"),
    (2, "/CapturePinasWPTeamMonday/images/postimages/2img3.png"),
    (2, "/CapturePinasWPTeamMonday/images/postimages/2img4.png"),
    (2, "/CapturePinasWPTeamMonday/images/postimages/2img5.png"),

    (3, "/CapturePinasWPTeamMonday/images/postimages/3img1.png"),
    (3, "/CapturePinasWPTeamMonday/images/postimages/3img2.png"),
    (3, "/CapturePinasWPTeamMonday/images/postimages/3img3.png"),
    (3, "/CapturePinasWPTeamMonday/images/postimages/3img4.png"),
    (3, "/CapturePinasWPTeamMonday/images/postimages/3img5.png"),
    (3, "/CapturePinasWPTeamMonday/images/postimages/3img6.png"),
    
    (4, "/CapturePinasWPTeamMonday/images/postimages/4img1.png"),
    
    (5, "/CapturePinasWPTeamMonday/images/postimages/5img1.png"),
    
    (6, "/CapturePinasWPTeamMonday/images/postimages/6img1.png"),
    (6, "/CapturePinasWPTeamMonday/images/postimages/6img2.png")
;

INSERT INTO userinfo (id, filepath, bio) VALUES 
    (1, "/CapturePinasWPTeamMonday/images/userimages/u1.png", "Teacher, athlete, programmer, photographer. I am the best in everything."),
    (2, "/CapturePinasWPTeamMonday/images/userimages/u2.png", "My goal is to be the best photographer PH."),
    (3, "/CapturePinasWPTeamMonday/images/userimages/u3.png", "Omae wa Mo Shindeiru (You are already dead) - Kenshirou (Fist of the North Star)"),    
    (4, "/CapturePinasWPTeamMonday/images/userimages/default.png", "Hi po! Hobby ko po ang mag picture kasi masaya po. Hope we can be friends!"),
    (5, "/CapturePinasWPTeamMonday/images/userimages/u5.png", "Need money for new camera T_T")
;

INSERT INTO userfav (id, postid) VALUES 
    (1, 1),
    (2, 1),
    
    (2, 2),
    (3, 2),
    (4, 2),
    (5, 2),
    
    (1, 3),
    
    (2, 4),
    (3, 4),
    (4, 4),
    
    (2, 6),
    (4, 6)

;
