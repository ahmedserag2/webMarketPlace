CREATE TABLE survey (
    survey_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    survey_name TEXT NOT NULL
);

CREATE TABLE question (
    question_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    survey_id INTEGER NOT NULL,
    question_text TEXT,
    is_required INTEGER,
    question_order INTEGER,
    FOREIGN KEY (survey_id) REFERENCES survey (survey_id) ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE survey_answer (
    survey_answer_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    survey_response_id INTEGER NOT NULL,
     survey_id INTEGER NOT NULL,
    question_id INTEGER NOT NULL,
    user_id  INT UNSIGNED NOT NULL,
    answer_value TEXT NOT NULL,
    FOREIGN KEY (survey_id) REFERENCES survey (survey_id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (question_id) REFERENCES question (question_id) ON UPDATE CASCADE ON DELETE CASCADE
    FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE
);


CREATE TABLE survey_sent_to(

    survey_id INTEGER NOT NULL,
    user_id INT UNSIGNED, 
    FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (survey_id) REFERENCES survey (survey_id) ON UPDATE CASCADE ON DELETE CASCADE
);