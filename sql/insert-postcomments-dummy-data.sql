USE capturepinas;

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
    
    (4, 2, "Great photo bro!", 3, 0, "2017-01-22 08:20:19"),
    (4, 5, "LOL thanks bro!", 1, 0, "2017-01-22 08:20:48"),
    (4, 4, "Wow its so pretty!", 3, 0, "2017-01-22 16:21:18"),
    (4, 3, "Nice job dude! Oh, and condolence to your camera..", 1, 0, "2017-01-22 17:24:38"),    

    (5, 2, "Condolences, bro", 1, 0, "2017-01-22 08:24:58"),    
    
    (6, 2, "Wow! Haha tara sama ako XD", 1, 0, "2017-02-03 23:14:22"),
    (6, 4, "Yun tara! Next week?", 1, 0, "2017-02-03 23:14:26"),
    (6, 2, "Gege pwede! hahaahha", 1, 0, "2017-02-03 23:14:32"),
    (6, 5, "I have no idea what you folks are talking about. Nice pics tho", 2, 0, "2017-02-04 09:34:26")
;
