student:
person_id

teacher:
person_id
// Et saaks teha

person:
person_id
person_phone
person_name

teacher_subjects
person_id
subject_id

test:
test_name
test_type_id
test_max_allowed_time NULL
test_max_allowed_attempts NULL
test_min_score NULL
test_author_id // person_id
subject_id NULL // Millise aine töö
lecture_id NULL // Millises tunnis see töö tehakse

test_question:
test_question_id PK
test_question_text
test_question_score float


test_question_answer:
test_question_id FK
test_question_answer_text
test_question_correct tinyint
test_question_type_id

test_question_type:
test_question_type_id
test_question_type_name // Jah/Ei, Valikvastustega, Täida lüngad

test_participants:
person_id
test_id
test_started_at timestamp DEFAULT CURRENT_TIMESTAMP
test_ended_at

-- Kes milliseid teste on teinud:
SELECT person_name, test_name COUNT(*)
FROM test_participants
  NATURAL JOIN person
  NATURAL JOIN test
GROUP BY person_id, test_id