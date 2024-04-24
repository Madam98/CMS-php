<?php

class DatabaseTables extends Database {


    public static function SQLtables() {
        return [

        // 1. TYPE_OF_USERS - users which can be defined in CMS panel 
        "CREATE TABLE IF NOT EXISTS TYPE_OF_USERS (
            type_of_users_id BIGINT NOT NULL AUTO_INCREMENT,
            user_type_name   varchar(100) DEFAULT NULL,
            PRIMARY KEY (type_of_users_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        // 2. USERS TABEL - user data fill during registration
        "CREATE TABLE IF NOT EXISTS USERS (
            user_id          BIGINT NOT NULL AUTO_INCREMENT,
            name             varchar(200) NOT NULL,
            surname          varchar(200) NOT NULL,
            email            varchar(200) NOT NULL,
            telephone        varchar(100) DEFAULT 0,
            address          varchar(200) DEFAULT NULL,
            type_of_users_id BIGINT DEFAULT 2,
            created_at       timestamp NOT NULL DEFAULT current_timestamp(),
            PRIMARY KEY (user_id),
            FOREIGN KEY (type_of_users_id) References TYPE_OF_USERS(type_of_users_id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        // 3. AUTHORIZATION - relation and to store log events
        "CREATE TABLE IF NOT EXISTS AUTHORIZATION (
            user_id          BIGINT NOT NULL,
            username         varchar(100) NOT NULL,
            password         varchar(200) NOT NULL,
            created_at       timestamp NOT NULL DEFAULT current_timestamp(),
            FOREIGN KEY (user_id) References USERS(user_id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        // 4. CATEGORY - to catalog type of post
        "CREATE TABLE IF NOT EXISTS CATEGORY (
            category_id BIGINT NOT NULL AUTO_INCREMENT,
            name        varchar(200) DEFAULT NULL,
            created_at  timestamp NOT NULL DEFAULT current_timestamp(),
            PRIMARY KEY (category_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        
        // 5. POST
        "CREATE TABLE IF NOT EXISTS POST (
            post_id         BIGINT NOT NULL AUTO_INCREMENT,
            title           varchar(200) NOT NULL,
            subtitle        varchar(200) NOT NULL,
            body            text NOT NULL,
            status          int(1) NOT NULL DEFAULT 0,
            user_id         BIGINT NOT NULL,
            image_pathname  varchar(200),
            category_id     BIGINT NOT NULL,
            created_at      timestamp NOT NULL DEFAULT current_timestamp(),
            PRIMARY KEY (post_id),
            FOREIGN KEY (user_id) References USERS(user_id) ON DELETE CASCADE,
            FOREIGN KEY (category_id) References CATEGORY(category_id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        // 6. IMAGE - database for image id and their paths
        // "CREATE TABLE IF NOT EXISTS IMAGE (
        //     image_id       BIGINT NOT NULL AUTO_INCREMENT,
        //     image_name     varchar(200) NOT NULL,
        //     image_pathname varchar(200) NOT NULL,
        //     post_id        BIGINT NOT NULL,
        //     created_at     timestamp NOT NULL DEFAULT current_timestamp(),
        //     PRIMARY KEY (image_id),
        //     FOREIGN KEY (post_id) References POST(post_id) ON DELETE CASCADE
        // ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",

        // 7. COMMENTS - comments created to post
        "CREATE TABLE IF NOT EXISTS COMMENT (
            comment_id          BIGINT NOT NULL AUTO_INCREMENT,
            username            varchar(100) NOT NULL,
            body                text NOT NULL,
            status              int(11) NOT NULL DEFAULT 0,
            post_id             BIGINT NOT NULL,
            created_at          timestamp NOT NULL DEFAULT current_timestamp(),
            PRIMARY KEY (comment_id),
            FOREIGN KEY (post_id) References POST(post_id) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4"
        ];
    }

    public static function SQLinsert(){ 
        return [

        // 1. TYPE_OF_USERS - users which can be defined in CMS panel 
        "INSERT INTO TYPE_OF_USERS (type_of_users_id, user_type_name) VALUES
            (1, 'administrator'),
            (2, 'editor')",
        
        // 2. USERS TABEL - user data fill during registration
            "INSERT INTO USERS (user_id, name, surname, email, telephone, address, type_of_users_id, created_at) VALUES
            (1,   'Adam',       'Miernicki',    'adambluebox1@gmail.com',           794205061, '23 Lutego',                     1, '2024-01-21 13:34:34'),
            (24,  'Jacek',      'Nowacki',      'jacek38@gmail.com',                212030204, '0162 Baker Road',               2, '2024-01-21 15:02:03'),
            (25,  'Margaret',   'Gutierrez',    'xrobertson@wp.pl',                 649804984, '35986 Jason Valleys Apt. 016',  2, '2024-01-21 18:14:54'),
            (27,  'Krzys',      'Castro',       'jeffreyfields@gmail.com',          340634156, '307 Susan Pike Apt. 836',       2, '2024-01-21 18:16:40'),
            (28,  'Lech',       'Rzeznik',      'smolenlove@interia.pl',            151886666, '3534 Allen Village Apt. 684',   2, '2024-01-21 21:06:37'),
            (29,  'Adolf',      'Gebels',       'adolf_gebels@gmail.com',           809511874, '676 Atkins Flats',              2, '2024-01-22 01:45:49'),
            (31,  'Johnathan',  'Rodriguez',    'amanda32@gmail.com',               197223087, '59585 Dawn Crescent',           2, '2024-01-22 19:13:37'),
            (32,  'Zofia',      'Mellisa',      'herbaciara@gmail.com',             449673600, '2678 Thomas Freeway',           2, '2024-01-23 02:57:51'),
            (33,  'Gregory',    'Rogers',       'tiffanyjohnson@gmail.com',         420651625, '5623 John Loaf Apt. 341',       2, '2024-01-24 01:22:50'),
            (34,  'Kevin',      'Hardy',        'stephanie11@gmail.com',            562187344, '910 Steele Corner',             2, '2024-01-24 05:42:26')",
        
        // 3. AUTHORIZATION - relation and to store log events

        // PASSWORDS
        // 1.  adammi        MAINportal76;
        // 2.  jacek         Password01
        // 3.  mar2001       Password01
        // 4.  krzys_casto   Password01
        // 5.  lech_jaroslaw Password01
        // 6.  threeThings   Password01
        // 7.  john          Password01
        // 8.  herbaciara    Password01
        // 9.  soliderRoger  Password01
        // 10. kevinSamAlone Password01

        "INSERT INTO AUTHORIZATION (user_id, username, password, created_at) VALUES
            (1,   'adammi',          '$2y$12\$E25MzSfpYGrAVg7C0mRXjOSHL5Gg3aMCWL9jAimJw6U3.1zxro7FW', '2024-01-21 13:34:34'),
            (24,  'jacek',           '$2y$12\$E25MzSfpYGrAVg7C0mRXjOSHL5Gg3aMCWL9jAimJw6U3.1zxro7FW',  '2024-01-21 15:02:03'),
            (25,  'mar2001',         '$2y$12\$E25MzSfpYGrAVg7C0mRXjOSHL5Gg3aMCWL9jAimJw6U3.1zxro7FW',  '2024-01-21 18:14:54'),
            (27,  'krzys_castro',    '$2y$12\$E25MzSfpYGrAVg7C0mRXjOSHL5Gg3aMCWL9jAimJw6U3.1zxro7FW',  '2024-01-21 18:16:40'),
            (28,  'lech_jaroslaw',   '$2y$12\$E25MzSfpYGrAVg7C0mRXjOSHL5Gg3aMCWL9jAimJw6U3.1zxro7FW',  '2024-01-21 21:06:37'),
            (29,  'threeThings',     '$2y$12\$E25MzSfpYGrAVg7C0mRXjOSHL5Gg3aMCWL9jAimJw6U3.1zxro7FW',  '2024-01-22 01:45:49'),
            (31,  'john',            '$2y$12\$E25MzSfpYGrAVg7C0mRXjOSHL5Gg3aMCWL9jAimJw6U3.1zxro7FW',  '2024-01-22 19:13:37'),
            (32,  'herbaciara',      '$2y$12\$E25MzSfpYGrAVg7C0mRXjOSHL5Gg3aMCWL9jAimJw6U3.1zxro7FW',  '2024-01-23 02:57:51'),
            (33,  'soliderRoger',    '$2y$12\$E25MzSfpYGrAVg7C0mRXjOSHL5Gg3aMCWL9jAimJw6U3.1zxro7FW',  '2024-01-24 01:22:50'),
            (34,  'kevinSamAlone',   '$2y$12\$E25MzSfpYGrAVg7C0mRXjOSHL5Gg3aMCWL9jAimJw6U3.1zxro7FW',  '2024-01-24 05:42:26')",

        // 4. CATEGORY - to catalog type of post
        "INSERT INTO CATEGORY (category_id, name, created_at) VALUES
            (1, 'NULL',     '2022-09-11 18:20:49'),
            (2, 'BACKEND',  '2022-09-11 18:20:49'),
            (3, 'FRONTEND', '2022-09-11 18:20:49'),
            (4, 'DEVOPS',   '2022-09-11 18:20:49'),
            (5, 'SECURITY', '2022-09-11 18:20:49')",
        
        // 5. POST
        "INSERT INTO POST (post_id, title, subtitle, body, status, user_id, image_pathname, category_id, created_at) VALUES
            (1, 'Applying 80-20 Rule to SRE', 'Egnyte Blog SRE', 'The Pareto principle states that 80% of results can come from 20% of efforts. I work on Egnyte Infrastructure team and the fact that this is a small group means we walk a fine line between keeping the system humming and making the necessary platform enhancements to handle the next growth spurt. The Pareto principle guides us to pick the right battles and by applying 20% of proactive efforts on the right problems, were able to prevent 80% of reactive problems. At the core of Egnyte Connect service is a Distributed File System and as with any other File System, the most common user operations include listing folders and uploading/downloading files. Our monitoring tools indicate that as the adoption of newer Desktop App clients increases, the average list folder performance went up from 50 milliseconds(ms) to 70ms in some data center zones (we call them Pods). In the past few months, weve made scalability enhancements to fix this and to also handle the next growth spurt, without adding much additional hardware. Now, 70ms is not a bad response time for list folder API, but if its called 100-200 million times, then that number can go up quickly. Even a 10ms improvement in performance can save 1-2 billion ms a day. How do you optimize something that is already fast? Well, sometimes ideas cross-pollinate when working on unrelated problems. Some relevant scalability enhancements we worked on include: Reduction of response size We have a REST API for listing files and folders with detailed responses to support different use cases. One day, while working on a specific use case, I realized that some of the cases require long, detailed responses while others dont. While looking at call frequency, I decided to trim one API response for a few high-frequency user-agents. I worked with the appropriate teams to change the implementation and create a reduced response size for these high-frequency user-agents. We left the other use cases be. Doing this had an interesting outcome: Trimming the response also reduced cache/database calls to load some compute-expensive fields. We saw around 100K fewer queries per minute in some of the Pods. Below is a screenshot from QA showing the nosedive in one of the queries.', 1, 1, '1705871666-8020.jpeg', 3, '2024-01-21 22:14:26'),
            (3, 'AEM Dispatcher with ease - Gradle AEM Plugins', 'Wunderman Blog Java', 'Developing AEM Dispatcher configuration can be challenging. The same attribution goes to httpd configuration, especially for developers without broad experience with it. This article will show how to ease this process with Gradle AEM Plugins using its live reload feature. GAP logo. AEM instance setup using Gradle was presented in a previous article, demonstrating how to set up AEM instances using Gradle AEM Plugins. In this blog post, we will extend this previous example with AEM Dispatcher to model a production environment locally. Furthermore, we will cover the live reload mode, a concept known from many JavaScript frameworks, where each code change is immediately reflected in the application itself. How to use this post? There are two ways you can benefit from this article. You can read it entirely to gain a good understanding of how the Environment plugin manages Dispatcher. You will know where to change the defaults and how to set up your projects. On the other hand, if you only want to explore the live reload feature, please cover the Prerequisites section, then download our example GAP project running AEM with Dispatcher, update the gradle.properties file, and navigate directly to Setting up the environment to continue reading. Prerequisites Quick reminder: Configure AEM. Lets start from the place where we had AEM instances configured and running - both author and publish on our local machine. Lets quickly review how our configuration looks like.', 1, 1, 'default.jpg', 1, '2024-01-21 18:17:40')
            ",
        
        
        

        // 6. IMAGES - database for image id and their paths
        // "INSERT INTO IMAGE (image_id, image_name, image_pathname, post_id, created_at) VALUES
        //     (1, '1.jpg', 'pathname/1.jpg', 1,  '2022-09-11 18:20:49'),
        //     (2, '1.jpg', 'pathname/1.jpg', 3,  '2022-09-11 18:20:49'),
        //     (3, '1.jpg', 'pathname/1.jpg', 10, '2022-09-11 18:20:49'),
        //     (4, '1.jpg', 'pathname/1.jpg', 11, '2022-09-11 18:20:49'),
        //     (5, '1.jpg', 'pathname/1.jpg', 12, '2022-09-11 18:20:49'),
        //     (6, '1.jpg', 'pathname/1.jpg', 13, '2022-09-11 18:20:49')"


        // 7. COMMENTS - comments created to post
        // "INSERT INTO COMMENT (`comment_id`, `username`, `body`, 'status_comment', 'post_id', 'created_at') VALUES
        //     (1, 'pepe', '2022-09-11 18:20:49'),
        //     (1, 'pepe', '2022-09-11 18:20:49'),
        //     (1, 'pepe', '2022-09-11 18:20:49'),
        //     (1, 'pepe', '2022-09-11 18:20:49'),
        //     (1, 'pepe', '2022-09-11 18:20:49'),
        //     (1, 'pepe', '2022-09-11 18:20:49')"
    ];
    }
}