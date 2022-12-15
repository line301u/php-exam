-- ------------------------------
-- OPTION
-- ------------------------------

OPTION IMPORT;

-- ------------------------------
-- TABLE: user
-- ------------------------------

DEFINE TABLE user SCHEMALESS PERMISSIONS NONE;

-- ------------------------------
-- TRANSACTION
-- ------------------------------

BEGIN TRANSACTION;

-- ------------------------------
-- TABLE DATA: user
-- ------------------------------

UPDATE user:2j9xvcgnrqbb6w5kc9k1 CONTENT { email: "lone@lonesen.com", first_name: "Lone", id: user:2j9xvcgnrqbb6w5kc9k1, image: "37fab8b00cc56af4056833ac3ed9a15d.jpeg", is_admin: "", last_name: "Lonesen", password: "$2y$10$cA3SSNyq4bl026fQUXkLdutg9ULAv1rgNOYx5gkadSjJRCdMIj5uW" };
UPDATE user:b7ijok5wrv08pp3vzxei CONTENT { email: "jens@jensen.com", first_name: "Jens", id: user:b7ijok5wrv08pp3vzxei, image: "232d5db6473bdc3cc46d58a2ff8d0117.jpeg", is_admin: "", last_name: "Jensen", password: "$2y$10$xQRIP/a0JqHIthJJ8ouFB.TL6P6KmVX0JQHN8opzuVVcHpE9joFiW" };
UPDATE user:i7umqixv2uhm051roo1i CONTENT { email: "karen@karensen.com", first_name: "Karen", id: user:i7umqixv2uhm051roo1i, image: "a9c0fb634ec298eea03af136faaa40dc.jpeg", is_admin: "", last_name: "Karensen", password: "$2y$10$XuE8I4nwrA3swRO5p6P94Ou0x6zK57AzSvjuoyLy7xzFx92wg7iwu" };
UPDATE user:ocge8rjdcmz2smoaynhy CONTENT { email: "lars@larsen.com", first_name: "Lars", id: user:ocge8rjdcmz2smoaynhy, image: "8e694d0066671a0abb776802df29be23.jpeg", is_admin: "", last_name: "Larsen", password: "$2y$10$rZOfNENoDEcc19TEyieDu.fPoV1HLh5d4ARHnmxfw9YWZEjSNimJ6" };
UPDATE user:ujpdy8gw04vn33hnyjto CONTENT { email: "admin@admin.com", first_name: "Admin", id: user:ujpdy8gw04vn33hnyjto, is_admin: true, last_name: "Adminsen", password: "$2y$10$xFGN33RbyVm7hXJMQFiiF.E2SuHdNsJhZ493jqeCOWalLxwYvuBeK" };

-- ------------------------------
-- TRANSACTION
-- ------------------------------

COMMIT TRANSACTION;

