create schema if not exists db_permissionManagement default character set utf8mb4 collate utf8mb4_unicode_ci;

create table if not exists db_permissionManagement.tb_users_accessLevels (
    id int auto_increment primary key
,   user_fk int not null, foreign key (user_fk) references db_accesses.accesses(id)
,   accessLevel_fk int not null, foreign key (accessLevel_fk) references db_accessLevel.accessLevels(id)
,   createdAt datetime default current_timestamp
,   updatedAt datetime default current_timestamp on update current_timestamp
) engine = InnoDB default charset = utf8mb4 collate = utf8mb4_unicode_ci;
